<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\GCOAppraisalRequest;
use Modules\HRM\Http\Requests\StoreAppraisalFirstEvaluation;
use Modules\HRM\Http\Requests\StoreAppraisalSecondEvaluation;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\GCOAppraisalRequestEvaluationService;

class GCOAppraisalRequestEvaluationController extends Controller
{
    protected $gcoAppraisalRequestEvaluationService;
    private $employeeService;

    public function __construct(GCOAppraisalRequestEvaluationService $gcoAppraisalRequestEvaluationService, EmployeeServices $employeeService)
    {
        $this->gcoAppraisalRequestEvaluationService = $gcoAppraisalRequestEvaluationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function firstEvaluation(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $evaluationQuestions = $this->gcoAppraisalRequestEvaluationService->getAllEvaluationQuestions();
        return view('hrm::gazetted-cadre-officer.request.1st-evaluation.create',
            compact('gcoAppraisalRequest', 'evaluationQuestions'
            ));
    }

    /**
     * Storing a new resource.
     * @param GCOAppraisalRequest $gcoAppraisalRequest
     * @param StoreAppraisalFirstEvaluation $request
     * @return Response
     */
    public function firstEvaluationStore(GCOAppraisalRequest $gcoAppraisalRequest, StoreAppraisalFirstEvaluation $request)
    {
        $status = $this->gcoAppraisalRequestEvaluationService->storeEvaluation($gcoAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('gco-appraisal-request.index');
        }

        return redirect()->route('gco-appraisal-request.second-evaluation', $gcoAppraisalRequest->id);
    }

    public function firstEvaluationEdit(GCOAppraisalRequest $gcoAppraisalRequest, Request $request)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        return view('hrm::gazetted-cadre-officer.request.1st-evaluation.edit',
            compact('gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Storing a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param Request $request
     * @return Response
     */
    public function firstEvaluationUpdate(GCOAppraisalRequest $gcoAppraisalRequest, Request $request)
    {

        $status = $this->gcoAppraisalRequestEvaluationService->updateEvaluation($gcoAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }

        return redirect()->route('gco-appraisal-request.second-evaluation', $gcoAppraisalRequest->id);
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function secondEvaluation(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];
        $result=[];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) =
            $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $reportingOfficers = $this->employeeService->getCROOfficer($gcoAppraisalRequest->employee_officer_id);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);

        return view('hrm::gazetted-cadre-officer.request.2nd-evaluation.create',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'totalRating',
                'reportingOfficers',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param StoreAppraisalSecondEvaluation $request
     * @return Response
     */
    public function secondEvaluationStore(NGAppraisalRequest $ngAppraisalRequest, Request $request)
    {
        $status = $this->gcoAppraisalRequestEvaluationService->storeSummarizedEvaluation($ngAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->summarizedEvaluation->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('ng-appraisal-request.index');
    }


    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function thirdEvaluation(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];
        $result=[];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) =
            $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $reportingOfficers = $this->employeeService->getCROOfficer($gcoAppraisalRequest->employee_officer_id);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.request.3rd-evaluation.create',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'totalRating',
                'reportingOfficers',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param StoreAppraisalSecondEvaluation $request
     * @return Response
     */
    public function thirdEvaluationStore(GCOAppraisalRequest $gcoAppraisalRequest, Request $request)
    {

        $status = $this->gcoAppraisalRequestEvaluationService->storeSummarizedEvaluation($gcoAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->summarizedEvaluation->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('gco-appraisal-request.index');
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
/*    public function secondEvaluationEdit(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);
        $reportingOfficers = $this->employeeService->getEmployeesWithOutRequesterDropdown();

        return view('hrm::non-gazetted.request.2nd-evaluation.edit',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'reportingOfficers',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }*/

    public function secondEvaluationShow(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);


        return view('hrm::gazetted-cadre-officer.request.2nd-evaluation.show',
            compact('ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));

    }
/*
    public function secondEvaluationUpdate(NGAppraisalRequest $ngAppraisalRequest, StoreAppraisalSecondEvaluation $request)
    {
        $status = $this->gcoAppraisalRequestEvaluationService->storeSummarizedEvaluationUpdate($ngAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('ng-appraisal-request.index');
    }*/
}
