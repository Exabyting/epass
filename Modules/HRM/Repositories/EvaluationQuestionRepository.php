<?php


namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\EvaluationQuestion;

class EvaluationQuestionRepository extends AbstractBaseRepository
{
    protected $modelName = EvaluationQuestion::class;
}
