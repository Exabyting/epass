<?php


namespace Modules\HRM\Services;


use App\Constants\NotificationType as NotificationTypeConstant;
use App\Services\RoleService;
use App\Traits\CrudTrait;
use App\Traits\MailSender;
use App\Traits\NotificationTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\HRM\Entities\GCOAppraisalRequestAction;
use Modules\HRM\Entities\GCOAppraisalRequestEvaluation;
use Modules\HRM\Entities\GCOAppraisalRequestSummarizedEvaluation;
use Modules\HRM\Repositories\GCOAppraisalRequestActionRepository as GCOAppraisalRequestActionRepositoryAlias;
use Modules\HRM\Repositories\GCOAppraisalRequestEvaluationRepository;
use Modules\HRM\Repositories\GCOEvaluationQuestionRepository;
use Modules\HRM\Traits\HistoryTrait;

class GCOAppraisalRequestEvaluationService
{
    use CrudTrait, NotificationTrait, HistoryTrait, MailSender;
    private $gcoAppraisalRequestEvaluationRepository;
    private $questionRepository;
    private $gcoAppraisalRequestActionRepository;
    private $roleService;


    public function __construct(
        GCOAppraisalRequestEvaluationRepository $gcoAppraisalRequestEvaluationRepository,
        GCOEvaluationQuestionRepository $questionRepository,
        GCOAppraisalRequestActionRepositoryAlias $gcoAppraisalRequestActionRepository,
        RoleService $roleService
    )
    {
        $this->gcoAppraisalRequestEvaluationRepository = $gcoAppraisalRequestEvaluationRepository;
        $this->questionRepository = $questionRepository;
        $this->gcoAppraisalRequestActionRepository = $gcoAppraisalRequestActionRepository;
        $this->roleService = $roleService;
        $this->setActionRepository($gcoAppraisalRequestEvaluationRepository);
    }

    /**
     * @return LengthAwarePaginator|Builder[]|Collection|Model[]
     */
    public function getAllEvaluationAction()
    {
        return $this->gcoAppraisalRequestActionRepository->findAll();
    }

    /**
     * @return Collection
     */
    public function getAllApprovedEvaluationAction()
    {
        return $this->gcoAppraisalRequestActionRepository->findBy(['action' => 'Approve']);
    }

    /**
     * @param Model $appraisalRequest
     * @return array
     */
    public function prepareEvaluationTable(Model $appraisalRequest)
    {

        $allEvaluationQuestions = $this->getAllEvaluationQuestions();
        $evaluationAnswers = $appraisalRequest->evaluations;
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];

        foreach ($allEvaluationQuestions as $evaluationQuestion) {

            $evaluation = $evaluationAnswers->firstWhere('evaluation_question_id', $evaluationQuestion->id);

            $evaluation = $evaluation ?: new GCOAppraisalRequestEvaluation();

            if ($evaluationQuestion->type == config('constants.question_type.primary')) {

                array_push($primaryTable, array(
                    'id' => $evaluationQuestion->id,
                    'position' => $evaluationQuestion->position,
                    'question' => $evaluationQuestion->question,
                    'answer' => $evaluation->rating,

                ));
            } elseif ($evaluationQuestion->type == config('constants.question_type.special')) {
                $evaluation = $evaluation ?: new GCOAppraisalRequestEvaluation();
                array_push($specialTable, array(
                    'id' => $evaluationQuestion->id,
                    'position' => $evaluationQuestion->position,
                    'question' => $evaluationQuestion->question ?: $evaluation->custom_question,
                    'answer' => $evaluation->rating,

                ));
            } elseif ($evaluationQuestion->type == config('constants.question_type.optional')) {
                $answer = null;
                $applicableRating = null;
                if ($evaluation) {
                    if ($evaluation->applicable_rating == 1) {
                        $answer = $evaluationQuestion->optional_answer_1;
                    } elseif ($evaluation->applicable_rating == 2) {
                        $answer = $evaluationQuestion->optional_answer_2;
                    }

                    $applicableRating = $evaluation->applicable_rating;
                }

                array_push($optionalTable, array(
                    'id' => $evaluationQuestion->id,
                    'position' => $evaluationQuestion->position,
                    'question' => $evaluationQuestion->question,
                    'optional_answer_1' => $evaluationQuestion->optional_answer_1,
                    'optional_answer_2' => $evaluationQuestion->optional_answer_2,
                    'applicableRating' => $applicableRating,
                    'answer' => $answer
                ));
            }

        }

        return [
            $primaryTable,
            $specialTable,
            $optionalTable,
            $allEvaluationQuestions
        ];
    }

    /**
     * @return LengthAwarePaginator|Builder[]|Collection|Model[]
     */
    public function getAllEvaluationQuestions()
    {
        return $this->questionRepository->findAll();
    }
    public function getTotalRating($primaryTable, $specialTable)
    {
        $results=array_merge($primaryTable, $specialTable);
        $sum =0;
        foreach($results as $result){
            $sum = $result['answer']+$sum;
        }
        return $sum;

    }

    /**
     * @param Model $appraisalRequest
     * @param array $data
     * @return mixed
     */
    public function storeEvaluation(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {

            $actorId = auth()->user()->employee->id;

            if (isset($data['rating'])) {
                foreach ($data['rating'] as $questionId => $rating) {
                    if ($this->isQuestionType($questionId, config('constants.question_type.primary'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);

                    } elseif ($this->isQuestionType($questionId, config('constants.question_type.special'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                            'custom_question' => isset($data['special'][$questionId]) ? $data['special'][$questionId] : null
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);
                    }
                }
            }

            if (isset($data['applicable_rating'])) {
                foreach ($data['applicable_rating'] as $questionId => $applicableRating) {
                    if ($this->isQuestionType($questionId, config('constants.question_type.optional'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'applicable_rating' => $applicableRating
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);
                    }
                }
            }

            $appraisalRequest->update(['is_evaluated' => 1]);

            // Keep History
            $this->pendingHistory($appraisalRequest, $appraisalRequest->receiver_id);


            return $appraisalRequest;
        });
    }

    /**
     * @param int $questionId
     * @param string $type
     * @return bool
     */
    private function isQuestionType(int $questionId, string $type): bool
    {
        $question = $this->questionRepository->findOrFail($questionId);
        return $question->type == $type;
    }

    /**
     * @param Model $appraisalRequest
     * @param array $data
     * @return mixed
     */
    public function updateEvaluation(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {

            $actorId = auth()->user()->employee->id;

            $appraisalRequest->evaluations()->delete();

            if (isset($data['rating'])) {
                foreach ($data['rating'] as $questionId => $rating) {
                    if ($this->isQuestionType($questionId, config('constants.question_type.primary'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);

                    } elseif ($this->isQuestionType($questionId, config('constants.question_type.special'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                            'custom_question' => isset($data['special'][$questionId]) ? $data['special'][$questionId] : null
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);
                    }
                }
            }

            if (isset($data['applicable_rating'])) {
                foreach ($data['applicable_rating'] as $questionId => $applicableRating) {
                    if ($this->isQuestionType($questionId, config('constants.question_type.optional'))) {
                        $appraisalRequestEvaluations = new GCOAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'applicable_rating' => $applicableRating
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);
                    }
                }
            }

            return $appraisalRequest;
        });
    }

    /**
     * @param Model $appraisalRequest
     * @param array $data
     * @return mixed
     */
    public function storeSummarizedEvaluation(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {

            $appraisalRequestEvaluations = new GCOAppraisalRequestSummarizedEvaluation([
                'actor_id' => auth()->user()->employee->id,
                'receiver_id' => $data['receiver_id'],
                'comment' => $data['comment'],
                'special_qualifications_options' => $data['special_qualifications_options'],
                'moral' => $data['moral'],
                'intellectual' => $data['intellectual'],
                'medical' => $data['medical'],
                'further_recommendation' => $data['further_recommendation'],
                'final_decision' => $data['final_decision'],
                'other_recommendation' => $data['other_recommendation'],


            ]);


            $appraisalRequest->summarizedEvaluation()->save($appraisalRequestEvaluations);

            $appraisalRequest->update(['is_evaluation_submitted' => 1]);

            // Keep History
            $this->evaluateHistory($appraisalRequest, $appraisalRequest->receiver_id, $data['receiver_id']);

            // TODO: Send Notification To Action Taker
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->summarizedEvaluation->receiver->user->id,
                "ACR Request Evaluation Submit",
                route('gco-appraisal-request.action', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->summarizedEvaluation->receiver;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('gco-appraisal-request.action', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            // TODO: Send Notification To Requester
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->requester->user->id,
                "ACR Request Evaluation Submit",
                route('gco-appraisal-request.show', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->requester;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('gco-appraisal-request.show', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            return $appraisalRequest;
        });
    }

    /**
     * @param Model $appraisalRequest
     * @param array $data
     * @return mixed
     */
    public function storeSummarizedEvaluationUpdate(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {
            $appraisalRequest->summarizedEvaluation()->delete();

            $appraisalRequestEvaluations = new GCOAppraisalRequestSummarizedEvaluation([
                'actor_id' => auth()->user()->employee->id,
                'receiver_id' => $data['receiver_id'],
                'summarized_rating' => $data['summarized_rating'],
                'final_decision' => $data['final_decision'],
                'comment' => $data['comment'],
            ]);

            $appraisalRequest->summarizedEvaluation()->save($appraisalRequestEvaluations);

            $appraisalRequest->update(['is_evaluation_submitted' => 1]);

            // Keep History
            $this->evaluateHistory($appraisalRequest, $appraisalRequest->receiver_id, $data['receiver_id']);

            // TODO: Send Notification To Action Taker
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->summarizedEvaluation->receiver->user->id,
                "ACR Request Evaluation Submit",
                route('gco-appraisal-request.action', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->summarizedEvaluation->receiver;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('gco-appraisal-request.action', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);


            // TODO: Send Notification To Requester
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->requester->user->id,
                "ACR Request Evaluation Submit",
                route('gco-appraisal-request.show', $appraisalRequest->id)
            );
            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->requester;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('gco-appraisal-request.show', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            return $appraisalRequest;
        });
    }

    /**
     * @param Model $appraisalRequest
     * @param array $data
     * @return mixed
     */
    public function requestAction(Model $appraisalRequest, array $data)
    {
        return DB::transaction(function () use ($appraisalRequest, $data) {
            $actorId = auth()->user()->employee->id;

            $appraisalRequestAction = new GCOAppraisalRequestAction([
                'actor_id' => $actorId,
                'action' => $data['action'],
                'rating' => $data['rating'],
                'comment' => $data['comment'],
                'total_marks' => $data['total_marks'],
            ]);
            $is_exist = $appraisalRequest->action;
            if ($is_exist) {
                $appraisalRequestAction = [
                    'actor_id' => $actorId,
                    'action' => $data['action'],
                    'rating' => $data['rating'],
                    'comment' => $data['comment'],
                    'total_marks' => $data['total_marks'],
                ];
                $appraisalRequest->action()->update($appraisalRequestAction);
            } else {
                $appraisalRequest->action()->save($appraisalRequestAction);
            }

            if ($data['action'] == 'Approve' || $data['action'] == 'Reject') {
                $appraisalRequest->update(['is_action_taken' => 1]);
            }

            $systemAnalystUser = $this->roleService->getSystemAnalystUser();
            $systemAdminUser = $this->roleService->getSystemAdminUser();

            // Send Notification
            if ($data['action'] == 'Approve') {

                // Keep History
                $this->gcoApproveHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

                // TODO: Send notification to Requester
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->requester->user->id,
                    "Your ACR Request has been Approved",
                    route('gco-appraisal-request.show', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->requester;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Approved";
                $url = route('gco-appraisal-request.show', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to Receiver
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->receiver->user->id,
                    "ACR Request has been Approved",
                    route('gco-appraisal-request.index', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->receiver;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Approved";
                $url = route('gco-appraisal-request.index', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Analyst
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAnalystUser->id,
                    "ACR Request has been Approved",
                    route('gco-appraisal-request.action-approved-view', $appraisalRequest->id)
                );
                //TODO: Send Email Notification
                $submittedTo = $systemAnalystUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Approved";
                $url = route('gco-appraisal-request.action-approved-view', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Admin
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAdminUser->id,
                    "ACR Request has been Approved",
                    route('gco-appraisal-request.action-approved-view', $appraisalRequest->id)
                );
                //TODO: Send Email Notification
                $submittedTo = $systemAdminUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Approved";
                $url = route('gco-appraisal-request.action-approved-view', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            } else if ($data['action'] == 'Save') {

                // Keep History
                $this->gcoApproveHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

                // TODO: Send notification to Requester
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->requester->user->id,
                    "Your ACR Request has been Saved",
                    route('gco-appraisal-request.show', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->requester;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Saved";
                $url = route('gco-appraisal-request.show', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to Receiver
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->receiver->user->id,
                    "ACR Request has been Saved",
                    route('gco-appraisal-request.index', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->receiver;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('gco-appraisal-request.index', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Analyst
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAnalystUser->id,
                    "ACR Request has been Saved",
                    route('gco-appraisal-request.action-edit', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $systemAnalystUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('gco-appraisal-request.action-edit', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Admin
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAdminUser->id,
                    "ACR Request has been Saved",
                    route('gco-appraisal-request.action-edit', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $systemAdminUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('gco-appraisal-request.action-edit', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            } else {
                // Keep History
                $this->gcoRejectHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

                // TODO: Send notification to Requester
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->requester->user->id,
                    "Your ACR Request has been Rejected",
                    route('gco-appraisal-request.index')
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->requester;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Rejected";
                $url = route('gco-appraisal-request.index');
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to Receiver
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->receiver->user->id,
                    "Your ACR Request has been Rejected",
                    route('gco-appraisal-request.index')
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->receiver;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Rejected";
                $url = route('gco-appraisal-request.index', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);
            }

            return $appraisalRequest;
        });
    }

    /**
     * @param int $questionId
     * @return Builder|Builder[]|Collection|Model|Model[]|mixed
     */
    private function getQuestion(int $questionId)
    {
        return $this->questionRepository->findOrFail($questionId);
    }

}
