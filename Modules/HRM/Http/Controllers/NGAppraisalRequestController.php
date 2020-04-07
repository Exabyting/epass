<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\NGAppraisalRequest;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\NGAppraisalRequestService;

class NGAppraisalRequestController extends Controller
{
    private $employeeService;
    private $ngAppraisalRequestService;

    public function __construct(NGAppraisalRequestService $ngAppraisalRequestService, EmployeeServices $employeeService)
    {
        $this->ngAppraisalRequestService = $ngAppraisalRequestService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $requests = $this->ngAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $allRequests = $this->ngAppraisalRequestService->getRequestsDataForDashboard();
        return view('hrm::non-gazetted.request.index', compact('allRequests', 'requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $startDateOfRequest = $this->ngAppraisalRequestService->getStartDateMinLimitOfNewRequest();
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        return view('hrm::non-gazetted.request.create', compact('reportingOfficers', 'startDateOfRequest'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $status = $this->ngAppraisalRequestService->saveRequest($request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }
        return redirect()->route('ng-appraisal-request.show', $status->id);
    }

    /**
     * Show the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function show(NGAppraisalRequest $ngAppraisalRequest)
    {
        return view('hrm::non-gazetted.request.show', compact('ngAppraisalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function edit(NGAppraisalRequest $ngAppraisalRequest)
    {
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        $jobHistories = $ngAppraisalRequest->jobHistories->map(function ($jh) {
            return ['designation' => $jh->designation, 'duration' => $jh->duration, 'salary_scale' => $jh->salary_scale];
        })->values();

        return view('hrm::non-gazetted.request.edit', compact('ngAppraisalRequest', 'jobHistories', 'reportingOfficers'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function update(Request $request, NGAppraisalRequest $ngAppraisalRequest)
    {
        $status = $this->ngAppraisalRequestService->updateRequest($ngAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }

        return redirect()->route('ng-appraisal-request.show', $ngAppraisalRequest->id);
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

    /**
     * Update the specified resource in storage.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function submit(NGAppraisalRequest $ngAppraisalRequest)
    {
        $status = $this->ngAppraisalRequestService->requestSubmit($ngAppraisalRequest);
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে  ।  </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()">  Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('ng-appraisal-request.index');
    }
}
