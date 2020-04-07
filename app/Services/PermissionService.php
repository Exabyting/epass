<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/10/18
 * Time: 12:01 PM
 */

namespace App\Services;


use App\Repositories\PermissionRepository;
use App\Traits\CrudTrait;
use Illuminate\Http\Response;

class PermissionService
{
    use CrudTrait;

    private $permissionRepository;
    private const PERMISSIONS = ['view', 'create', 'update', 'delete'];

    /**
     * PermissionService constructor.
     * @param $permissionRepository
     */
    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->setActionRepository($this->permissionRepository);
    }

    public function getPermissions()
    {
        $permissions = $this->permissionRepository->getPermissions();
        return $permissions;
    }


    public function store($modelName)
    {
        //Create permission for crud operations at a time
        foreach (PermissionService::PERMISSIONS as $permission) {
            $this->permissionRepository->create($modelName, $permission);
        }
        return new Response("Permissions have been created successfully");
    }

    public function destroy($id)
    {
        $permission = $this->findOrFail($id);
        DB::transaction(function () use ($permission) {
           $permission->detach('roles');
           $permission->delete();
        });
        return new Response("Permissions have been deleted successfully");
    }
}
