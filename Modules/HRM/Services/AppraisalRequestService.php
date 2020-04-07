<?php

namespace Modules\HRM\Services;

use App\Constants\NotificationType as NotificationTypeConstant;
use App\Mail\AppraisalRequestNotificationEmail;
use App\Traits\CrudTrait;
use App\Traits\MailSender;
use App\Traits\NotificationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\AppraisalRequestJobHistory;
use Modules\HRM\Repositories\AppraisalRequestRepository;
use Modules\HRM\Traits\HistoryTrait;

class AppraisalRequestService
{
    use CrudTrait, NotificationTrait, HistoryTrait, MailSender;
    private const REQUEST_SUBMITTED = 1;
    private const REQUEST_NOT_SUBMITTED = 0;
    private const EVALUATION_SUBMITTED = 1;
    private const EVALUATION_NOT_SUBMITTED = 0;
    private const EVALUATED = 1;
    private const NOT_EVALUATED = 0;
    private const ACTION_TAKEN = 1;
    private const ACTION_NOT_TAKEN = 0;
    private $appraisalRequestRepository;
    private $appraisalRequestEvaluationService;
    private $employeeServices;

    public function __construct(
        AppraisalRequestRepository $appraisalRequestRepository,
        AppraisalRequestEvaluationService $appraisalRequestEvaluationService,
        EmployeeServices $employeeServices
    )
    {
        $this->appraisalRequestRepository = $appraisalRequestRepository;
        $this->appraisalRequestEvaluationService = $appraisalRequestEvaluationService;
        $this->employeeServices = $employeeServices;
        $this->setActionRepository($appraisalRequestRepository);
    }

    public function saveRequest(array $data)
    {
        return DB::transaction(function () use ($data) {

            $employee = auth()->user()->employee;
            $data['requester_id'] = $employee->id;
            $officer = $employee->officers->where('id', $data['employee_officer_id'])->first();
            $data['receiver_id'] = $officer->iro_id;
            $data['reporting_date_start'] = $officer->start_date;
            $data['reporting_date_end'] = $officer->end_date;

            $appraisalRequest = $this->save($data);
            if (isset($data['job-history'])) {

                foreach ($data['job-history'] as $jobHistory) {
                    $appraisalRequestJobHistory = new AppraisalRequestJobHistory([
                        'designation' => $jobHistory['designation'],
                        'duration' => $jobHistory['duration'],
                        'salary_scale' => $jobHistory['salary_scale'],
                    ]);
                    $appraisalRequest->jobHistories()->save($appraisalRequestJobHistory);
                }
            }

            return $appraisalRequest;
        });
    }

    public function updateRequest(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {

            $employee = auth()->user()->employee;
            $officer = $employee->officers->where('id', $data['employee_officer_id'])->first();
            $data['receiver_id'] = $officer->iro_id;
            $data['reporting_date_start'] = $officer->start_date;
            $data['reporting_date_end'] = $officer->end_date;

            $this->update($appraisalRequest, $data);

            if (isset($data['job-history'])) {
                $appraisalRequest->jobHistories()->delete();

                foreach ($data['job-history'] as $jobHistory) {
                    $appraisalRequestJobHistory = new AppraisalRequestJobHistory([
                        'designation' => $jobHistory['designation'],
                        'duration' => $jobHistory['duration'],
                        'salary_scale' => $jobHistory['salary_scale'],
                    ]);
                    $appraisalRequest->jobHistories()->save($appraisalRequestJobHistory);
                }

            }

            return $appraisalRequest;
        });
    }

    public function requestSubmit(Model $appraisalRequest)
    {
        return DB::transaction(function () use ($appraisalRequest) {

            $appraisalRequest->update(['is_submitted' => 1]);

            // Keep History
            $this->initiateHistory($appraisalRequest, $appraisalRequest->requester_id, $appraisalRequest->receiver_id);

            $employee = $this->employeeServices->findOne(auth()->user()->employee->id);
            $employeeOfficer = $employee->officers->where('id', $appraisalRequest->employee_officer_id)
                                                  ->where('is_complete', 0)->first();
            $employeeOfficer->update(['is_complete' => 1]);

            //TODO:  Send Notification To Receiver
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST,
                $appraisalRequest->id,
                $appraisalRequest->receiver->user->id,
                "ACR Request Submitted",
                route('appraisal-request.first-evaluation', $appraisalRequest->id)
            );

            //TODO: Send Email Notification

            $submittedToPerson = $appraisalRequest->receiver;
            $submittedByPerson = $appraisalRequest->requester;
            $message = "ACR Request Submitted";
            $route = route('appraisal-request.first-evaluation', $appraisalRequest->id);
            $toEmailAddress = $submittedToPerson->email;
            $toEmailName = "জনাব " . $submittedToPerson->first_name . " " . $submittedToPerson->last_name;
            if (env('USE_SYSTEM_MAIL')) {
                $toEmailAddress = env('MAIL_USERNAME', "towfiq.projects@gmail.com");
            }
            $mailable = new AppraisalRequestNotificationEmail(
                $submittedByPerson,
                $message,
                $route,
                $toEmailAddress,
                $toEmailName
            );
            $this->sendEmail($toEmailAddress, $mailable);

            return $appraisalRequest;
        });
    }

    public function getFilteredRequest()
    {
        $employeeId = auth()->user()->employee->id;
        $requests = $this->findAll()->where('is_action_taken', self::ACTION_NOT_TAKEN);
//        $final_actor_id = $this->appraisalRequestEvaluationService->finalActorID(1);

        switch (true) {
            case auth()->user()->hasAnyRole(['ROLE_SYSTEM_ANALYST']):
                return $requests;
            default:
                $requests = $requests->filter(function ($request) use ($employeeId) {
                    return $request->requester_id == $employeeId || $request->receiver_id == $employeeId;
                });
                return $requests;
        }
    }

    public function getFilteredRequestReceiverRequesterActionTaker()
    {
        $employeeId = auth()->user()->employee->id;
        $requests = $this->findAll()->where('is_action_taken', self::ACTION_TAKEN);

        switch (true) {
            case /* auth()->user()->hasAnyRole(['ROLE_SYSTEM_ANALYST']) || */ auth()->user()->hasAnyRole(['ROLE_SUPER_ADMIN']) :
                return $requests;
            default:
                return $requests->filter(function ($request) use ($employeeId) {
                    return $request->requester_id == $employeeId ||
                        $request->receiver_id == $employeeId ||
                        $request->action->actor_id == $employeeId;
                });
        }
    }

    public function getEvaluatedRequests()
    {
        return $this->findBy(['is_evaluation_submitted' => self::EVALUATION_SUBMITTED]);
    }

    public function getActionTakenRequests()
    {
        return $this->findBy(['is_action_taken' => self::ACTION_TAKEN]);
    }

    public function getDataForDashboard()
    {
        $currentUser = auth()->user();
        //$actionTakenRequests = $evaluatedRequests = collect();

        $evaluatedRequests = $this->findBy(['is_evaluation_submitted' => self::EVALUATION_SUBMITTED])
            ->filter(function ($item) use ($currentUser) {
                return $item->receiver_id == $currentUser->employee->id;
            });
        $actionTakenRequests = $this->findBy(['is_action_taken' => self::ACTION_TAKEN])
            ->filter(function ($item) use ($currentUser) {
                return $item->action->actor_id == $currentUser->employee->id;
            });;

        return compact('actionTakenRequests', 'evaluatedRequests');
    }

    public function isEligibleForCreateRequest()
    {
        $dateAfterThreeMonths = $this->getStartDateMinLimitOfNewRequest();

        if ($dateAfterThreeMonths) {
            return Carbon::now()->gte($dateAfterThreeMonths);
        }

        return true;
    }

    public function getStartDateMinLimitOfNewRequest()
    {
        $lastACRRequest = $this->getLastACRRequestOfCurrentUser();

        if ($lastACRRequest) {
            $lastACRRequestEndDate = new Carbon($lastACRRequest->reporting_date_end);
            return $lastACRRequestEndDate->addMonth(3)->format('Y-m-d');
        }

        return false;
    }

    private function getLastACRRequestOfCurrentUser()
    {
        $employeeId = auth()->user()->employee->id;
        return $this->findBy(['requester_id' => $employeeId])->last();
    }

    public function getRequestsDataForDashboard()
    {
        $currentUserEmployeeId = auth()->user()->employee->id;
        $notSubmittedRequests = $notEvaluatedRequests = $evaluationNotSubmittedRequests
            = $actionNotTakenRequests = collect();

        $notSubmittedRequests = $this->findBy(['is_submitted' => self::REQUEST_NOT_SUBMITTED])
            ->filter(function ($item) use ($currentUserEmployeeId) {
                return $item->requester_id == $currentUserEmployeeId;
            });

        $notEvaluatedRequests = $this->findBy([
            'is_evaluated' => self::NOT_EVALUATED,
            'is_submitted' => self::REQUEST_SUBMITTED
        ])
            ->filter(function ($item) use ($currentUserEmployeeId) {
                return $item->receiver_id == $currentUserEmployeeId || $item->requester_id == $currentUserEmployeeId;
            });

        $evaluationNotSubmittedRequests = $this->findBy([
            'is_evaluated' => self::EVALUATED,
            'is_evaluation_submitted' => self::EVALUATION_NOT_SUBMITTED,
        ])
            ->filter(function ($item) use ($currentUserEmployeeId) {
                return $item->receiver_id == $currentUserEmployeeId || $item->requester_id == $currentUserEmployeeId;
            });

        $actionNotTakenRequests = $this->findBy([
            'is_evaluated' => self::EVALUATED,
            'is_evaluation_submitted' => self::EVALUATION_SUBMITTED,
            'is_action_taken' => self::ACTION_NOT_TAKEN,
        ])
            ->filter(function ($item) use ($currentUserEmployeeId) {
                return $item->summarizedEvaluation->actor_id == $currentUserEmployeeId ||
                    $item->summarizedEvaluation->receiver_id == $currentUserEmployeeId ||
                    $item->requester_id == $currentUserEmployeeId;
            });

        $allRequests = $this->combinedRequests(
            $notEvaluatedRequests,
            $evaluationNotSubmittedRequests,
            $actionNotTakenRequests,
            $notSubmittedRequests
        );

        return $allRequests;
    }


    private function combinedRequests()
    {
        $reports = collect();
        $arg = func_get_args();

        foreach ($arg as $items) {
            foreach ($items as $item) {
                $reports->push($item);
            }
        }

        return $reports;
    }
}
