<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalReport;
use Modules\HRM\Http\Requests\StoreAppraisalReport;
use Modules\HRM\Services\AppraisalReportService;
use Modules\HRM\Services\EmployeeServices;

class AppraisalReportController extends Controller
{
    private $employeeService;
    private $appraisalReportService;

    public function __construct(AppraisalReportService $appraisalReportService, EmployeeServices $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->appraisalReportService = $appraisalReportService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $appraisalReports = $this->appraisalReportService->findAll()->sortByDesc('id');
        return view('hrm::appraisal.report.index', compact('appraisalReports'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $reportingOfficers = $this->employeeService->getEmployeesWithOutRequesterDropdown();
        return view('hrm::appraisal.report.create', compact('reportingOfficers'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreAppraisalReport $request)
    {
        $status = $this->appraisalReportService->saveReport($request->all());

        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে  ।  </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()">  Print Now</a>');
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }

        return redirect()->route('appraisal-report.index');
    }


    /**
     * Show the specified resource.
     * @param AppraisalReport $appraisalReport
     * @return Response
     */
    public function show(AppraisalReport $appraisalReport)
    {
        return view('hrm::appraisal.report.show', compact('appraisalReport'));
    }

    /**
     * @param AppraisalReport $appraisalReport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrint(AppraisalReport $appraisalReport)
    {
        return view('hrm::appraisal.report.print',
            compact('appraisalReport'));
    }

    /**
     * @param AppraisalReport $appraisalReport
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrintPreview(AppraisalReport $appraisalReport)
    {
        return view('hrm::appraisal.report.print-preview',
            compact('appraisalReport'));
    }
}
