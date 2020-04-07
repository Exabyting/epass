<?php
/**
 * Created by PhpStorm.
 * User: BS100
 * Date: 10/30/2018
 * Time: 12:44 PM
 */

namespace Modules\HRM\Repositories;


use App\Repositories\AbstractBaseRepository;
use Modules\HRM\Entities\Designation;


class DesignationRepository extends AbstractBaseRepository
{
    protected $modelName = Designation::class;

    public function getDesignationsByShortCode($shortName)
    {
        $designations = $this->modelName::whereIn('short_name', $shortName)->get();
        return $designations;
    }

}