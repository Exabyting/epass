<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalRequest;
use Modules\HRM\Http\Requests\StoreAppraisalRequest;
use Modules\HRM\Services\AppraisalRequestService;
use Modules\HRM\Services\EmployeeServices;

class AppraisalRequestController extends Controller
{
    private $employeeService;
    private $appraisalRequestService;

    public function __construct(AppraisalRequestService $appraisalRequestService, EmployeeServices $employeeService)
    {
        $this->appraisalRequestService = $appraisalRequestService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $requests = $this->appraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $allRequests = $this->appraisalRequestService->getRequestsDataForDashboard();
        return view('hrm::appraisal.request.index', compact('allRequests', 'requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
//        if (!$this->appraisalRequestService->isEligibleForCreateRequest()){
//            Session::flash('error', 'পূর্ববর্তী অনুরোধ জমা দেওয়ার তিন মাসের মধ্যে যোগ্য নয়');
//            return redirect()->route('appraisal-request.index');
//        }

        $startDateOfRequest = $this->appraisalRequestService->getStartDateMinLimitOfNewRequest();
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        return view('hrm::appraisal.request.create', compact('reportingOfficers', 'startDateOfRequest'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StoreAppraisalRequest $request)
    {
        $status = $this->appraisalRequestService->saveRequest($request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('appraisal-request.index');
        }

        return redirect()->route('appraisal-request.show', $status->id);
    }

    /**
     * Show the specified resource.
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function show(AppraisalRequest $appraisalRequest)
    {
        return view('hrm::appraisal.request.show', compact('appraisalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function edit(AppraisalRequest $appraisalRequest)
    {
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        $jobHistories = $appraisalRequest->jobHistories->map(function ($jh) {
            return ['designation' => $jh->designation, 'duration' => $jh->duration, 'salary_scale' => $jh->salary_scale];
        })->values();

        return view('hrm::appraisal.request.edit', compact(
            'appraisalRequest', 'jobHistories', 'reportingOfficers'
        ));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function update(Request $request, AppraisalRequest $appraisalRequest)
    {
        $status = $this->appraisalRequestService->updateRequest($appraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('appraisal-request.index');
        }

        return redirect()->route('appraisal-request.show', $appraisalRequest->id);
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function submit(AppraisalRequest $appraisalRequest)
    {
        $status = $this->appraisalRequestService->requestSubmit($appraisalRequest);
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে  ।  </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()">  Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('appraisal-request.index');
    }
}
