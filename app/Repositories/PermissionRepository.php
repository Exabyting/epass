<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/10/18
 * Time: 11:55 AM
 */

namespace App\Repositories;


use App\Entities\Permission;

class PermissionRepository extends AbstractBaseRepository
{
    protected $modelName = Permission::class;

    public function getPermissions()
    {
        //Concat model name to permissions for readability
        $permissions = Permission::selectRaw('CONCAT(CONCAT(model_name, \'::\'), name) as name, id')->pluck('name', 'id');
        return $permissions;
    }

    public function create($modelName, $permissionName)
    {
        $permission = Permission::create(['model_name'=>$modelName, 'name'=>$permissionName,
            'description' => $permissionName. ' permission for '.$modelName]);
        return $permission;
    }
}
