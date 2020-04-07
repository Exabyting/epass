<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    protected $fillable = [
        'position',
        'question',
        'type',
        'optional_answer_1',
        'optional_answer_2'
    ];
}
