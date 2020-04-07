<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/9/18
 * Time: 2:56 PM
 */

namespace App\Repositories;

use App\Entities\Role;

class RoleRepository extends AbstractBaseRepository
{
    protected $modelName = Role::class;

    public function pluck()
    {
        return $this->getModel()->pluck('name', 'id');
    }


}
