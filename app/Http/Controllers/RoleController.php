<?php

namespace App\Http\Controllers;

use App\Entities\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    private $roleService;
    private $permissionService;

    /**
     * RoleController constructor.
     * @param $roleService
     * @param $permissionService
     */
    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
        $this->authorizeResource(Role::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', Role::class);
        $roles = $this->roleService->getRolesWithPermission();
        return view('role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Role::class);
        $permissions = $this->permissionService->getPermissions();
        return view('role.create', compact('permissions'));
    }


    /**
     * @param StoreRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create', Role::class);
        $response = $this->roleService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/user/role');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('view', Role::class);
        $role = $this->roleService->findOrFail($id);
        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $this->authorize('update');
        $role = $this->roleService->findOrFail($id);
        $permissions = $this->permissionService->getPermissions();
        return view('role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRoleRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRoleRequest $request, $id)
    {
        $this->authorize('update');
        $response = $this->roleService->updateRole($id, $request->all());
        Session::flash('message', $response->getContent());

        return redirect('/user/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('delete');
        $response = $this->roleService->destroy($id);
        Session::flash('message', $response->getContent());
        return redirect('/user/role');
    }
}
