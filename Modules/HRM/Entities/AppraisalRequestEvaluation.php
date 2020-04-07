<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class AppraisalRequestEvaluation extends Model
{
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
        return $this->belongsTo(AppraisalRequest::class, 'appraisal_request_id', 'id');
    }

    public function actor()
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'id');
    }

    public function evaluationQuestion()
    {
        return $this->hasOne(EvaluationQuestion::class, 'evaluation_question_id', 'id');
    }
}
