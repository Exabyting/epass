<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreDepartmentRequest;
use Modules\HRM\Services\DepartmentService;

class DepartmentController extends Controller {

	protected $departmentService;

	public function __construct( DepartmentService $departmentService ) {
		$this->departmentService = $departmentService;
	}

	public function index() {
		$departmentList = $this->departmentService->getDepartmentList();

		return view( 'hrm::department.index', compact( 'departmentList' ) );
	}


	public function create() {
		return view( 'hrm::department.create' );
	}


	public function store( StoreDepartmentRequest $request ) {
		$response = $this->departmentService->storeDepartment( $request->all() );
		Session::flash( 'message', $response->getContent() );

		return redirect()->route( 'department.index' );

	}


	public function show( $id ) {
		$department = $this->departmentService->getDepartmentById( $id );

		return view( 'hrm::department.show', compact( 'department' ) );
	}


	public function edit( $id ) {
		$department = $this->departmentService->getDepartmentById( $id );

		return view( 'hrm::department.edit', compact( 'department' ) );

	}


	public function update( StoreDepartmentRequest $request, $id ) {
		$response = $this->departmentService->updateDepartment( $request->all(), $id );
		Session::flash( 'message', $response->getContent() );
        return redirect()->route('department.index');
		//return redirect()->route( 'department.edit', $response->getId() );
	}

	public function destroy($id) {
//		$response = $this->departmentService->deleteDepartment($id);
//		Session::flash( 'message', $response->getContent() );

		return redirect()->route( 'department.index' );

	}
}
