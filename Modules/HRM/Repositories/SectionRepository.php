<?php
/**
 * Created by PhpStorm.
 * User: bs130
 * Date: 6/24/19
 * Time: 11:25 AM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Section;

class SectionRepository extends AbstractBaseRepository
{
    protected $modelName = Section::class;

}