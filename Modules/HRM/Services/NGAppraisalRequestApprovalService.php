<?php


namespace Modules\HRM\Services;


use App\Constants\NotificationType as NotificationTypeConstant;
use App\Services\RoleService;
use App\Traits\CrudTrait;
use App\Traits\MailSender;
use App\Traits\NotificationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\NGAppraisalRequestApproval;
use Modules\HRM\Repositories\NGAppraisalRequestApprovalRepository;

class NGAppraisalRequestApprovalService
{
    use CrudTrait, NotificationTrait, MailSender;
    private $ngAppraisalRequestApprovalRepository;
    private $roleService;


    public function __construct
    (
        NGAppraisalRequestApprovalRepository $ngAppraisalRequestApprovalRepository,
        RoleService $roleService
    )
    {
        $this->roleService = $roleService;
        $this->ngAppraisalRequestApprovalRepository = $ngAppraisalRequestApprovalRepository;
        $this->setActionRepository($ngAppraisalRequestApprovalRepository);
    }


    public function saveRequest(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {
            $data['actor_id'] = auth()->user()->employee->id;
            strtolower($data['action']) === 'approve' ? $data['status'] = 'Completed' : $data['status'] = 'On processing';

            $appraisalRequestApproval = $this->findBy(['appraisal_request_id' => $appraisalRequest->id])->first();
            if ($appraisalRequestApproval == null) {
                $appraisalRequestApproval = new NGAppraisalRequestApproval($data);
                $appraisalRequestApproval->save();
            } else {
                $appraisalRequestApproval->update($data);
            }

            $systemAnalystUser = $this->roleService->getSystemAnalystUser();
            $systemAdminUser = $this->roleService->getSystemAdminUser();

            // TODO: Send notification to Requester
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->requester->user->id,
                "Your ACR Request has been Approved",
                route('ng-appraisal-request.show', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->requester;
            $submittedBy = $appraisalRequest->requester;
            $msg = "Your ACR Request has been Approved";
            $url = route('ng-appraisal-request.show', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            // TODO: Send notification to Receiver
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->receiver->user->id,
                "ACR Request has been Approved",
                route('ng-appraisal-request.index', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->receiver;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request has been Approved";
            $url = route('ng-appraisal-request.index', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            // TODO: Send notification to System Analyst
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $systemAnalystUser->id,
                "ACR Request has been Approved",
                route('ng-appraisal-request.action-approved-view', $appraisalRequest->id)
            );
            //TODO: Send Email Notification
            $submittedTo = $systemAnalystUser->employee;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request has been Approved";
            $url = route('ng-appraisal-request.action-approved-view', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            // TODO: Send notification to System Admin
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $systemAdminUser->id,
                "ACR Request has been Approved",
                route('ng-appraisal-request.action-approved-view', $appraisalRequest->id)
            );
            //TODO: Send Email Notification
            $submittedTo = $systemAdminUser->employee;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request has been Approved";
            $url = route('ng-appraisal-request.action-approved-view', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            return $appraisalRequestApproval;
        });
    }

}
