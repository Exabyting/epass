<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class GCOEvaluationQuestion extends Model
{
    protected $table = 'gco_evaluation_questions';

    protected $fillable = [
        'position',
        'question',
        'type',
        'optional_answer_1',
        'optional_answer_2',
    ];
}
