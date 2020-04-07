<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\HRM\Services\AppraisalReportService;
use Modules\HRM\Services\AppraisalRequestService;
use Modules\HRM\Services\DepartmentService;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\NGAppraisalRequestService;

class ReportingController extends Controller
{
    private $employeeService;
    private $appraisalRequestService;
    private $ngAppraisalRequestService;
    private $appraisalReportService;
    private $departmentService;

    public function __construct(
        AppraisalRequestService $appraisalRequestService,
        NGAppraisalRequestService $ngAppraisalRequestService,
        AppraisalReportService $appraisalReportService,
        EmployeeServices $employeeService,
        DepartmentService $departmentService
    )
    {
        $this->appraisalRequestService = $appraisalRequestService;
        $this->ngAppraisalRequestService = $ngAppraisalRequestService;
        $this->appraisalReportService = $appraisalReportService;
        $this->employeeService = $employeeService;
        $this->departmentService = $departmentService;
    }

    public function allAcrRequest()
    {
        [$reports, $ngReports] = $this->combinedReports();

        $requesters = $this->employeeService->getEmployeesOnlyRequester();
        $departments = $this->departmentService->getDepartmentList();
        return view('hrm::reporting.all-acr-request', compact('reports', 'requesters', 'departments', 'ngReports'));
    }

    private function combinedReports()
    {
        $reports = collect();

        $reports = $this->appraisalRequestService->getActionTakenRequests();
        $ngReports = $this->ngAppraisalRequestService->getActionTakenRequests();
        $appraisalReports = $this->appraisalReportService->findAll();

        foreach ($appraisalReports as $appraisalReport) {
            $reports->push($appraisalReport);
        }

        return [$reports, $ngReports];
    }

    public function submitterAndNonSubmitterList()
    {
        $allRequester = [];
        [$reports, $ngReports] = $this->combinedReports();

        $employees = $this->employeeService->getEmployeesOnlyRequester();

        foreach ($ngReports as $report) {
            $reports->push($report);
        }

        foreach ($reports as $report) {
            array_push($allRequester, $report->requester->id);
        }

        $requestSubmitters = $employees->filter(function ($employee) use ($allRequester) {

            return in_array($employee->id, $allRequester);

        })->map(function ($employee) use ($reports) {

            $lastReport = $reports->where('requester_id', $employee->id)->sortByDesc('id')->values()->first();
            $employee->last_application_date = $lastReport;

            return $employee;
        });

        $requestNonSubmitters = $employees->filter(function ($employee) use ($allRequester) {
            return !in_array($employee->id, $allRequester);
        });

//        dd($allRequester, $requestSubmitters, $requestNonSubmitters);

        return view('hrm::reporting.acr-request-submitters', compact('requestSubmitters', 'requestNonSubmitters'));
    }

}
