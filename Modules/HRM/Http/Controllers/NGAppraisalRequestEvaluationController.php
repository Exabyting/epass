<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\NGAppraisalRequest;
use Modules\HRM\Http\Requests\StoreAppraisalFirstEvaluation;
use Modules\HRM\Http\Requests\StoreAppraisalSecondEvaluation;
use Modules\HRM\Services\EmployeeServices;
use Modules\HRM\Services\NGAppraisalRequestEvaluationService;

class NGAppraisalRequestEvaluationController extends Controller
{
    protected $ngAppraisalRequestEvaluationService;
    private $employeeService;

    public function __construct(NGAppraisalRequestEvaluationService $ngAppraisalRequestEvaluationService, EmployeeServices $employeeService)
    {
        $this->ngAppraisalRequestEvaluationService = $ngAppraisalRequestEvaluationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function firstEvaluation(NGAppraisalRequest $ngAppraisalRequest)
    {
        $evaluationQuestions = $this->ngAppraisalRequestEvaluationService->getAllEvaluationQuestions();
        return view('hrm::non-gazetted.request.1st-evaluation.create',
            compact('ngAppraisalRequest', 'evaluationQuestions'
            ));
    }

    /**
     * Storing a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param StoreAppraisalFirstEvaluation $request
     * @return Response
     */
    public function firstEvaluationStore(NGAppraisalRequest $ngAppraisalRequest, StoreAppraisalFirstEvaluation $request)
    {
        $status = $this->ngAppraisalRequestEvaluationService->storeEvaluation($ngAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }

        return redirect()->route('ng-appraisal-request.second-evaluation', $ngAppraisalRequest->id);
    }

    public function firstEvaluationEdit(NGAppraisalRequest $ngAppraisalRequest, Request $request)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.request.1st-evaluation.edit',
            compact('ngAppraisalRequest',
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
    public function firstEvaluationUpdate(NGAppraisalRequest $ngAppraisalRequest, Request $request)
    {
        $status = $this->ngAppraisalRequestEvaluationService->updateEvaluation($ngAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('ng-appraisal-request.index');
        }

        return redirect()->route('ng-appraisal-request.second-evaluation', $ngAppraisalRequest->id);
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function secondEvaluation(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) =
            $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        $reportingOfficers = $this->employeeService->getCROOfficer($ngAppraisalRequest->employee_officer_id);

        return view('hrm::non-gazetted.request.2nd-evaluation.create',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
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
        $status = $this->ngAppraisalRequestEvaluationService->storeSummarizedEvaluation($ngAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->summarizedEvaluation->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('ng-appraisal-request.index');
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function secondEvaluationEdit(NGAppraisalRequest $ngAppraisalRequest)
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
    }

    public function secondEvaluationShow(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.request.2nd-evaluation.show',
            compact('ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));

    }

    public function secondEvaluationUpdate(NGAppraisalRequest $ngAppraisalRequest, StoreAppraisalSecondEvaluation $request)
    {
        $status = $this->ngAppraisalRequestEvaluationService->storeSummarizedEvaluationUpdate($ngAppraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('ng-appraisal-request.index');
    }
}
