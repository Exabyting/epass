<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 11/22/18
 * Time: 1:09 PM
 */

namespace App\Http\Controllers;


use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userService;
    private $roleService;

    /**
     * UserController constructor.
     * @param $userService
     * @param $roleService
     */
    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->userService->findAll();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = $this->roleService->pluck();
        $userTypes = config('user.types');
        $status = config('user.status');
        return view('user.create', compact('roles', 'userTypes', 'status'));
    }

    /**
     * @param StoreUserRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $response = $this->userService->store($request->all());
        Session::flash('message', $response->getContent());
        return redirect('/system/user');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userService->findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userService->findOrFail($id);
        $roles = $this->roleService->pluck();
        $userTypes = config('user.types');
        $status = config('user.status');
        return view('user.edit', compact('user', 'roles', 'userTypes', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $response = $this->userService->updateUser($id, $request->all());
        Session::flash('message', $response->getContent());

        return redirect('/system/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
//        $response = $this->userService->destroy($id);
//        Session::flash('message', $response->getContent());
        return redirect('/system/user');
    }

    public function changeSpecialStatus(Request $request)
    {
        $status = $this->userService->specialStatus($request->id, $request);
        return response()->json(['code' => 200, 'success' => trans('labels.save_success', ['date' => date('d M Y, h:i A', time())])]);
    }
}
