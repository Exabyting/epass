<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalRequestSummarizedEvaluation extends Model
{
    protected $fillable = [
        'appraisal_request_id',
        'actor_id',
        'receiver_id',
        'summarized_rating',
        'final_decision',
        'comment'
    ];

    public function appraisalRequest()
    {
        return $this->belongsTo(AppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(Employee::class, 'receiver_id', 'id');
    }

}
