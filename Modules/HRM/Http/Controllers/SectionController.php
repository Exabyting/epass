<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Http\Requests\StoreSectionRequest;
use Modules\HRM\Repositories\DepartmentRepository;
use Modules\HRM\Repositories\SectionRepository;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\SectionService;

class SectionController extends Controller
{
    private $sectionService;
    private $departmentRepository;
    private $employeeService;

    public function __construct(SectionService $sectionService,
                                EmployeeServices $employeeService,
                                DepartmentRepository $departmentRepository)
    {
        $this->sectionService = $sectionService;
        $this->departmentRepository = $departmentRepository;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $sections = $this->sectionService->findAll();
        return view('hrm::section.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $departments = $this->departmentRepository->findAll();
//        $employees = $this->employeeService->getEmployeesForDropdown();
        return view('hrm::section.create', compact('employees', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSectionRequest $request
     * @return Response
     */
    public function store(StoreSectionRequest $request)
    {
        $this->sectionService->storeSection($request->all());
        Session::flash('message', trans('labels.update_success', ['date' => date('d M Y, h:i A',time())]));
        return redirect(route('sections.index'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionService->findOne($id);
        $sectionHead = $section->head;
        return view('hrm::section.show', compact('section', 'sectionHead'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $departments = $this->departmentRepository->findAll();
        $employees = $this->employeeService->getEmployeesForDropdown();
        $section = $this->sectionService->findOne($id);
        return view('hrm::section.edit', compact('departments', 'employees', 'section'));
    }

    /**
     * Update the specified resource in storage.
     * @param StoreSectionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreSectionRequest $request, $id)
    {
        $this->sectionService->updateSection($request->all(), $id);
        Session::flash('message', trans('labels.update_success', ['date' => date('d M Y, h:i A',time())]));
        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
//        $this->sectionService->delete($id);
//        Session::flash('error', trans('labels.delete_success', ['date' => date('d M Y, h:i A',time())]));
        return redirect(route('sections.index'));
    }

    public function getAllByDeptId($deptId)
    {
        return $this->sectionService->findBy(['department_id' => $deptId]);
    }

}
