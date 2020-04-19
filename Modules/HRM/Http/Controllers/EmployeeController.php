<?php

namespace Modules\HRM\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\EmployeeOfficer;
use Modules\HRM\Http\Requests\StoreEmployeeGeneralInfoRequest;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\DesignationService;
use Modules\HRM\Services\EmployeeServices;

class EmployeeController extends Controller
{

    private $employeeService;
    private $departmentService;
    private $designationService;


    private $employeeTrainingService;

    public function __construct(
        EmployeeServices $employeeServices,
        DepartmentService $departmentService,
        DesignationService $designationService
    )
    {
        $this->employeeService = $employeeServices;
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
    }


    public function index()
    {
        $employeeList = $this->employeeService->getEmployeeList();
        return view('hrm::employee.index', compact('employeeList'));
    }


    public function create(Request $request)
    {
        /*$employeeList = $this->employeeService->getEmployeesWithOutRequesterDropdown();*/
        $departments = $this->departmentService->getDepartments();
        $designations = $this->designationService->getDesignations();
        $employeeTitles = $this->employeeService->getEmployeeTitles();
        $employee_id = isset($request->employee) ? $request->employee : '';
        $photoUrl = '';

        return view('hrm::employee.create', compact(
                'departments',
                'designations',
                'employee_id',
                'employeeTitles',
                'photoUrl',
                'employeeList'
            )
        );
    }


    public function store(StoreEmployeeGeneralInfoRequest $request)
    {
        $response = $this->employeeService->storeGeneralInfo($request->all());
        Session::flash('message', $response->getContent());

        return redirect()->route('employee.index');
    }

    public function show($id)
    {
        $employee = $this->employeeService->findOne($id, ['department']);
        return view('hrm::employee.show', compact('employee'));
    }

    public function edit($id)
    {
       /* $employeeList = $this->employeeService->getEmployeesWithOutRequesterDropdown();*/
        $departments = $this->departmentService->getDepartments();
        $designations = $this->designationService->getDesignations();
        $employeeTitles = $this->employeeService->getEmployeeTitles();
        $employee = $this->employeeService->findOne($id, ['department']);
        $photoUrl = (!empty($employee->photo)) ? 'employee-profile/' . $employee->photo : 'employee-profile/default.png';

        return view('hrm::employee.edit', compact(
            'departments', 'designations',
            'employee', 'employeeTitles',
            'photoUrl', 'employeeList'
        ));
    }

    public function update(StoreEmployeeGeneralInfoRequest $request, $id)
    {
        $response = $this->employeeService->updateGeneralInfo($request->all(), $id);
        Session::flash('message', $response->getContent());
        $employee_id = $response->getId();

        return redirect('/hrm/employee/' . $employee_id);
    }
}
