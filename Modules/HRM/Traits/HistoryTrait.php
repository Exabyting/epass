<?php


namespace Modules\HRM\Traits;


use Illuminate\Database\Eloquent\Model;
use Modules\HRM\Constants\ACRHistoryStatus;
use Modules\HRM\Entities\AppraisalRequestHistory;
use Modules\HRM\Entities\NGAppraisalRequestHistory;
use Modules\HRM\Entities\GCOAppraisalRequestHistory;

trait HistoryTrait
{


    public function initiateHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new AppraisalRequestHistory([
            'transition' => ACRHistoryStatus::INITIATED,
            'from' => ACRHistoryStatus::INITIATED,
            //'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }

    public function ngInitiateHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new NGAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::INITIATED,
            'from' => ACRHistoryStatus::INITIATED,
            //'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }

    public function pendingHistory(Model $request, $actor) : void
    {
        $request->histories()->save(new AppraisalRequestHistory([
            'transition' => ACRHistoryStatus::PENDING,
            'from' => ACRHistoryStatus::INITIATED,
            'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => null,
        ]));
    }
    public function ngPendingHistory(Model $request, $actor) : void
    {
        $request->histories()->save(new NGAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::PENDING,
            'from' => ACRHistoryStatus::INITIATED,
            'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => null,
        ]));
    }

    public function evaluateHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new AppraisalRequestHistory([
            'transition' => ACRHistoryStatus::EVALUATED,
            'from' => ACRHistoryStatus::PENDING,
            'to' => ACRHistoryStatus::EVALUATED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }


    public function approveHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new AppraisalRequestHistory([
            'transition' => ACRHistoryStatus::APPROVED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::APPROVED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }

    public function ngApproveHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new NGAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::APPROVED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::APPROVED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }

    public function rejectHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new AppraisalRequestHistory([
            'transition' => ACRHistoryStatus::REJECTED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::REJECTED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }

    public function ngRejectHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new NGAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::REJECTED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::REJECTED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }
    //GCO
    public function gcoInitiateHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new GCOAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::INITIATED,
            'from' => ACRHistoryStatus::INITIATED,
            //'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }
    public function gcoApproveHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new GCOAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::APPROVED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::APPROVED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }
    public function gcoPendingHistory(Model $request, $actor) : void
    {
        $request->histories()->save(new GCOAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::PENDING,
            'from' => ACRHistoryStatus::INITIATED,
            'to' => ACRHistoryStatus::PENDING,
            'actor_id' => $actor,
            'recipient_id' => null,
        ]));
    }
    public function gcoRejectHistory(Model $request, $actor, $recipient) : void
    {
        $request->histories()->save(new NGAppraisalRequestHistory([
            'transition' => ACRHistoryStatus::REJECTED,
            'from' => ACRHistoryStatus::EVALUATED,
            'to' => ACRHistoryStatus::REJECTED,
            'actor_id' => $actor,
            'recipient_id' => $recipient ,
        ]));
    }


}
