<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class NGAppraisalRequestEvaluation extends Model
{
    protected $table = 'ng_appraisal_request_evaluations';

    protected $fillable = [
        'appraisal_request_id',
        'actor_id',
        'evaluation_question_id',
        'rating',
        'comment',
        'custom_question', // for Special Questions
        'applicable_rating' // for Optional Questions
    ];

    public function appraisalRequest()
    {
        return $this->belongsTo(NGAppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }

    public function evaluationQuestion()
    {
        return $this->hasOne(NGEvaluationQuestion::class, 'evaluation_question_id', 'id');
    }
}
