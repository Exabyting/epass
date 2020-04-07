<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\GCOAppraisalPersonalRequest;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\GCOAppraisalRequestService;
use Modules\HRM\Services\GCOAppraisalPersonalRequestService;
use Modules\HRM\Entities\GCOAppraisalRequest;

class GCOAppraisalPersonalRequestController extends Controller
{
    private $employeeService;
    private $gcoAppraisalPersonalRequestService;

    public function __construct(GCOAppraisalPersonalRequestService $gcoAppraisalPersonalRequestService, EmployeeServices $employeeService)
    {
        $this->gcoAppraisalPersonalRequestService = $gcoAppraisalPersonalRequestService;
        $this->employeeService = $employeeService;
    }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $requests = $this->gcoAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $allRequests = $this->gcoAppraisalRequestService->getRequestsDataForDashboard();
        return view('hrm::gazetted-cadre-officer.request.index', compact('allRequests', 'requests'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(GCOAppraisalRequest $gcoAppraisalRequestId)
    {
        //dd($gcoAppraisalRequestId);
        $startDateOfRequest = $this->gcoAppraisalPersonalRequestService->getStartDateMinLimitOfNewRequest();
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        return view('hrm::gazetted-cadre-officer.request.personal.create', compact('reportingOfficers', 'startDateOfRequest','gcoAppraisalRequestId'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $status = $this->gcoAppraisalPersonalRequestService->saveRequest($request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('gco-appraisal-request.index');
        }
        return redirect()->route('gco-appraisal-personal-request.show', $status->id);
    }

    /**
     * Show the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function show(GCOAppraisalPersonalRequest $gcoAppraisalRequest)
    {
        return view('hrm::gazetted-cadre-officer.request.personal.show', compact('gcoAppraisalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function edit(GCOAppraisalPersonalRequest $gcoAppraisalRequest)
    {

        $reportingOfficers = $this->employeeService->getIROOfficers('iro');


   /*     $jobHistories = $gcoAppraisalRequest->jobHistories->map(function ($jh) {
            return ['designation' => $jh->designation, 'duration' => $jh->duration, 'salary_scale' => $jh->salary_scale];
        })->values();*/
       // $photoUrl = (!empty($gcoAppraisalRequest->medical_report_photo)) ? $gcoAppraisalRequest->medical_report_photo : 'employee-profile/default.png';

        return view('hrm::gazetted-cadre-officer.request.personal.edit', compact('gcoAppraisalRequest','reportingOfficers'));
    }

        /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */

    public function update(Request $request, GCOAppraisalPersonalRequest $gcoAppraisalRequest)
    {

        $status = $this->gcoAppraisalPersonalRequestService->updateRequest($gcoAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }

        return redirect()->route('gco-appraisal-personal-request.show', $gcoAppraisalRequest->id);
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
    public function submit(GCOAppraisalPersonalRequest $gcoAppraisalRequest)
    {
        //dd($gcoAppraisalRequest);
        $status = $this->gcoAppraisalPersonalRequestService->requestSubmit($gcoAppraisalRequest);
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে  ।  </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()">  Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('gco-appraisal-request.index');
    }
}
