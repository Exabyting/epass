<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestSummarizedEvaluation extends Model
{
    protected $table = 'gco_appraisal_request_summarized_evaluations';

    protected $fillable = [
        'appraisal_request_id',
        'actor_id',
        'receiver_id',
        'comment',
        'special_qualifications_options',
        'moral',
        'intellectual',
        'medical',
        'further_recommendation',
        'final_decision',
        'other_recommendation',
    ];

    public function appraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'appraisal_request_id', 'id');
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