<?php
/**
 * Created by PhpStorm.
 * User: siaminflack
 * Date: 4/3/19
 * Time: 5:36 PM
 */

namespace App\Services\Notification;


use App\Entities\workflow\Feature;
use App\Services\workflow\WorkFlowConversationService;
use App\Services\workflow\WorkflowMasterService;
use Illuminate\Database\Eloquent\Model;
use Modules\PMS\Entities\ProjectProposal;

class ReviewUrlGenerator
{
    /**
     * @var WorkflowMasterService
     */
    private $workflowMasterService;
    /**
     * @var WorkFlowConversationService
     */
    private $workFlowConversationService;

    /**
     * ReviewUrlGenerator constructor.
     * @param WorkflowMasterService $workflowMasterService
     * @param WorkFlowConversationService $workFlowConversationService
     */
    public function __construct(
        WorkflowMasterService $workflowMasterService,
        WorkFlowConversationService $workFlowConversationService
    )
    {
        $this->workflowMasterService = $workflowMasterService;
        $this->workFlowConversationService = $workFlowConversationService;
    }

    public function getReviewUrl($routeName, Feature $feature, Model $notifiable): string
    {

        $workflowMaster = $this->workflowMasterService->findBy([
            'feature_id' => $feature->id,
            'rule_master_id' => $feature->workflowRuleMaster->id,
            'ref_table_id' => $notifiable->id,
        ])->first();

        $workflowRuleDetail = $feature->workflowRuleMaster->ruleDetails
            ->where('rule_master_id', $feature->workflowRuleMaster->id)
            ->where('notification_order', 1)
            ->first();;

        $workflowConversation = $this->workFlowConversationService->getActiveConversationByWorkFlow($workflowMaster->id);

        $url = route(
            $routeName,
            array_merge([
                'proposalId' => $workflowMaster->ref_table_id,
                'wfMasterId' => $workflowMaster->id,
                'wfConvId' => $workflowConversation->id,
                'ruleDetailsId' => $workflowRuleDetail->id
            ], $this->getKeyValue($notifiable, $feature))
        );

        return $url;
    }

    /**
     * @param Model $model
     * @param Feature $feature
     * @return array
     */
    private function getKeyValue(Model $model, Feature $feature): array
    {
        if ($model instanceof ProjectProposal) {
            return ['featureId' => $feature->id];
        } else {
            return ['featureName' => $feature->name];
        }
    }
}