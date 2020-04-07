<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\GCOAppraisalRequest;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\GCOAppraisalRequestService;


class GCOAppraisalRequestController extends Controller
{
    private $employeeService;
    private $gcoAppraisalRequestService;

    public function __construct(GCOAppraisalRequestService $gcoAppraisalRequestService, EmployeeServices $employeeService)
    {
        $this->gcoAppraisalRequestService = $gcoAppraisalRequestService;
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
        $personalInfo = $this->gcoAppraisalRequestService->isPersonalInfoComplete();
        return view('hrm::gazetted-cadre-officer.request.index', compact('allRequests', 'requests','personalInfo'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {

        $startDateOfRequest = $this->gcoAppraisalRequestService->getStartDateMinLimitOfNewRequest();
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');
        $medicalReport = $this->gcoAppraisalRequestService->isComplete();
        $personalInfo = $this->gcoAppraisalRequestService->isPersonalInfoComplete();
        if(($medicalReport == null)&&($personalInfo == null)){
            return view('hrm::gazetted-cadre-officer.request.create', compact('reportingOfficers', 'startDateOfRequest','medicalReport'));
        }
        elseif((($medicalReport->is_submitted)== 1)&& (($personalInfo->is_submitted)== 1)){
            return view('hrm::gazetted-cadre-officer.request.create', compact('reportingOfficers', 'startDateOfRequest','medicalReport'));
        }
        else{
            if (($medicalReport->is_submitted)== 1) {

                //return redirect()->route('gco-appraisal-personal-request.create');
                return redirect()->route('gco-appraisal-personal-request.create',$medicalReport->id);
            }
            else {
                return view('hrm::gazetted-cadre-officer.request.create', compact('reportingOfficers', 'startDateOfRequest','medicalReport'));
            }
        }

    }
    public function getDownload()
    {
        //TODO:: update this user download status
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/manual/medical-report.pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, 'medical-report.pdf', $headers);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $status = $this->gcoAppraisalRequestService->saveRequest($request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('gco-appraisal-request.index');
        }
        return redirect()->route('gco-appraisal-request.show', $status->id);
    }

    /**
     * Show the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function show(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        return view('hrm::gazetted-cadre-officer.request.show', compact('gcoAppraisalRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function edit(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $reportingOfficers = $this->employeeService->getIROOfficers('iro');

        $jobHistories = $gcoAppraisalRequest->jobHistories->map(function ($jh) {
            return ['designation' => $jh->designation, 'duration' => $jh->duration, 'salary_scale' => $jh->salary_scale];
        })->values();
       // $photoUrl = (!empty($gcoAppraisalRequest->medical_report_photo)) ? $gcoAppraisalRequest->medical_report_photo : 'employee-profile/default.png';

        return view('hrm::gazetted-cadre-officer.request.edit', compact('gcoAppraisalRequest', 'jobHistories', 'reportingOfficers'));
    }

        /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */

    public function update(Request $request, GCOAppraisalRequest $gcoAppraisalRequest)
    {

        //dd($request->hasFile('medical_report_photo'));
        $status = $this->gcoAppraisalRequestService->updateRequest($gcoAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('gco-appraisal-request.index');
        }

        return redirect()->route('gco-appraisal-request.show', $gcoAppraisalRequest->id);
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
    public function submit(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $status = $this->gcoAppraisalRequestService->requestSubmit($gcoAppraisalRequest);
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
           /* Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে  ।  </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()">  Print Now</a>');*/
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('gco-appraisal-personal-request.create',$gcoAppraisalRequest->id);
    }
}
