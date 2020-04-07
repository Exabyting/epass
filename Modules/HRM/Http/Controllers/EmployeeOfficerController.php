<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\EmployeeOfficer;
use Modules\HRM\Services\EmployeeServices;

class EmployeeOfficerController extends Controller
{
    private $employeeService;


    /**
     * HRMController constructor.
     * @param EmployeeServices $employeeServices
     */
    public function __construct(EmployeeServices $employeeServices)
    {
        $this->employeeService = $employeeServices;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $allEmployees = $this->employeeService->getEmployeesForDropdown();
        return view('hrm::employee.employee-officer.create', compact('allEmployees'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $status = $this->employeeService->storeEmployeeOfficer($request->all());
        if ($status) {
            Session::flash('success', 'Create Successful.');
        } else {
            Session::flash('error', 'Create Failed.');
        }

        return redirect()->route('employee-officer.create');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param EmployeeOfficer $employeeOfficer
     * @return Response
     */
    public function edit(EmployeeOfficer $employeeOfficer)
    {
        $employeeList = $this->employeeService->getEmployeesWithOutRequesterDropdown();
        return view('hrm::employee.employee-officer.edit', compact('employeeOfficer', 'employeeList'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param EmployeeOfficer $employeeOfficer
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, EmployeeOfficer $employeeOfficer)
    {
        $status = $employeeOfficer->update($request->all());
        if ($status) {
            Session::flash('success', 'Update Successful');
        } else {
            Session::flash('error', 'Update Failed');
        }

        return redirect('/hrm/employee/' . $employeeOfficer->employee_id);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
