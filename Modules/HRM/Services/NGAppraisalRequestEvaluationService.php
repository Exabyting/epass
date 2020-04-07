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
use Modules\HRM\Entities\NGAppraisalRequestAction;
use Modules\HRM\Entities\NGAppraisalRequestEvaluation;
use Modules\HRM\Entities\NGAppraisalRequestSummarizedEvaluation;
use Modules\HRM\Repositories\NGAppraisalRequestActionRepository as NGAppraisalRequestActionRepositoryAlias;
use Modules\HRM\Repositories\NGAppraisalRequestEvaluationRepository;
use Modules\HRM\Repositories\NGEvaluationQuestionRepository;
use Modules\HRM\Traits\HistoryTrait;

class NGAppraisalRequestEvaluationService
{
    use CrudTrait, NotificationTrait, HistoryTrait, MailSender;
    private $ngAppraisalRequestEvaluationRepository;
    private $questionRepository;
    private $ngAppraisalRequestActionRepository;
    private $roleService;


    public function __construct(
        NGAppraisalRequestEvaluationRepository $ngAppraisalRequestEvaluationRepository,
        NGEvaluationQuestionRepository $questionRepository,
        NGAppraisalRequestActionRepositoryAlias $ngAppraisalRequestActionRepository,
        RoleService $roleService
    )
    {
        $this->ngAppraisalRequestEvaluationRepository = $ngAppraisalRequestEvaluationRepository;
        $this->questionRepository = $questionRepository;
        $this->ngAppraisalRequestActionRepository = $ngAppraisalRequestActionRepository;
        $this->roleService = $roleService;
        $this->setActionRepository($ngAppraisalRequestEvaluationRepository);
    }

    /**
     * @return LengthAwarePaginator|Builder[]|Collection|Model[]
     */
    public function getAllEvaluationAction()
    {
        return $this->ngAppraisalRequestActionRepository->findAll();
    }

    /**
     * @return Collection
     */
    public function getAllApprovedEvaluationAction()
    {
        return $this->ngAppraisalRequestActionRepository->findBy(['action' => 'Approve']);
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

            $evaluation = $evaluation ?: new NGAppraisalRequestEvaluation();

            if ($evaluationQuestion->type == config('constants.question_type.primary')) {

                array_push($primaryTable, array(
                    'id' => $evaluationQuestion->id,
                    'position' => $evaluationQuestion->position,
                    'question' => $evaluationQuestion->question,
                    'answer' => $evaluation->rating,
                    'comment' => $evaluation->comment,
                ));
            } elseif ($evaluationQuestion->type == config('constants.question_type.special')) {
                $evaluation = $evaluation ?: new NGAppraisalRequestEvaluation();
                array_push($specialTable, array(
                    'id' => $evaluationQuestion->id,
                    'position' => $evaluationQuestion->position,
                    'question' => $evaluationQuestion->question ?: $evaluation->custom_question,
                    'answer' => $evaluation->rating,
                    'comment' => $evaluation->comment,
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
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);

                    } elseif ($this->isQuestionType($questionId, config('constants.question_type.special'))) {
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
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
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
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
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
                            'actor_id' => $actorId,
                            'evaluation_question_id' => $questionId,
                            'rating' => $rating,
                        ]);
                        $appraisalRequest->evaluations()->save($appraisalRequestEvaluations);

                    } elseif ($this->isQuestionType($questionId, config('constants.question_type.special'))) {
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
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
                        $appraisalRequestEvaluations = new NGAppraisalRequestEvaluation([
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

            $appraisalRequestEvaluations = new NGAppraisalRequestSummarizedEvaluation([
                'actor_id' => auth()->user()->employee->id,
                'receiver_id' => $data['receiver_id'],
                'summarized_rating' => $data['summarized_rating'],
                'final_decision' => $data['final_decision'],

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
                route('ng-appraisal-request.action', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->summarizedEvaluation->receiver;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('ng-appraisal-request.action', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            // TODO: Send Notification To Requester
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->requester->user->id,
                "ACR Request Evaluation Submit",
                route('ng-appraisal-request.show', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->requester;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('ng-appraisal-request.show', $appraisalRequest->id);
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

            $appraisalRequestEvaluations = new NGAppraisalRequestSummarizedEvaluation([
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
                route('ng-appraisal-request.action', $appraisalRequest->id)
            );

            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->summarizedEvaluation->receiver;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('ng-appraisal-request.action', $appraisalRequest->id);
            $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);


            // TODO: Send Notification To Requester
            $this->sendNotification(
                NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                $appraisalRequest->id,
                $appraisalRequest->requester->user->id,
                "ACR Request Evaluation Submit",
                route('ng-appraisal-request.show', $appraisalRequest->id)
            );
            //TODO: Send Email Notification
            $submittedTo = $appraisalRequest->requester;
            $submittedBy = $appraisalRequest->requester;
            $msg = "ACR Request Evaluation Submit";
            $url = route('ng-appraisal-request.show', $appraisalRequest->id);
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

            $appraisalRequestAction = new NGAppraisalRequestAction([
                'actor_id' => $actorId,
                'action' => $data['action'],
                'rating' => $data['rating'],
                'comment' => $data['comment'],
            ]);
            $is_exist = $appraisalRequest->action;
            if ($is_exist) {
                $appraisalRequestAction = [
                    'actor_id' => $actorId,
                    'action' => $data['action'],
                    'rating' => $data['rating'],
                    'comment' => $data['comment'],
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
                $this->approveHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

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

            } else if ($data['action'] == 'Save') {

                // Keep History
                $this->approveHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

                // TODO: Send notification to Requester
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->requester->user->id,
                    "Your ACR Request has been Saved",
                    route('ng-appraisal-request.show', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->requester;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Saved";
                $url = route('ng-appraisal-request.show', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to Receiver
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->receiver->user->id,
                    "ACR Request has been Saved",
                    route('ng-appraisal-request.index', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->receiver;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('ng-appraisal-request.index', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Analyst
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAnalystUser->id,
                    "ACR Request has been Saved",
                    route('ng-appraisal-request.action-edit', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $systemAnalystUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('ng-appraisal-request.action-edit', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to System Admin
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $systemAdminUser->id,
                    "ACR Request has been Saved",
                    route('ng-appraisal-request.action-edit', $appraisalRequest->id)
                );

                //TODO: Send Email Notification
                $submittedTo = $systemAdminUser->employee;
                $submittedBy = $appraisalRequest->requester;
                $msg = "ACR Request has been Saved";
                $url = route('ng-appraisal-request.action-edit', $appraisalRequest->id);
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

            } else {
                // Keep History
                $this->rejectHistory($appraisalRequest, $actorId, $systemAnalystUser->employee->id);

                // TODO: Send notification to Requester
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->requester->user->id,
                    "Your ACR Request has been Rejected",
                    route('ng-appraisal-request.index')
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->requester;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Rejected";
                $url = route('ng-appraisal-request.index');
                $this->EmailNotificationValues($submittedTo, $submittedBy, $msg, $url);

                // TODO: Send notification to Receiver
                $this->sendNotification(
                    NotificationTypeConstant::ACR_REQUEST_EVALUATION_SUBMIT,
                    $appraisalRequest->id,
                    $appraisalRequest->receiver->user->id,
                    "Your ACR Request has been Rejected",
                    route('ng-appraisal-request.index')
                );

                //TODO: Send Email Notification
                $submittedTo = $appraisalRequest->receiver;
                $submittedBy = $appraisalRequest->requester;
                $msg = "Your ACR Request has been Rejected";
                $url = route('ng-appraisal-request.index', $appraisalRequest->id);
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
