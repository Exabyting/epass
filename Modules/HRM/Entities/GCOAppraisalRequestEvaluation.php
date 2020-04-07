<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOAppraisalRequestEvaluation extends Model
{
    protected $table = 'gco_appraisal_request_evaluations';

    protected $fillable = [
        'appraisal_request_id',
        'actor_id',
        'evaluation_question_id',
        'rating'
    ];

    public function appraisalRequest()
    {
        return $this->belongsTo(GCOAppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }

    public function evaluationQuestion()
    {
        return $this->hasOne(GCOEvaluationQuestion::class, 'evaluation_question_id', 'id');
    }
}
