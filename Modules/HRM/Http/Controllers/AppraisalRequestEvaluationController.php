<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalRequest;
use Modules\HRM\Http\Requests\StoreAppraisalFirstEvaluation;
use Modules\HRM\Http\Requests\StoreAppraisalSecondEvaluation;
use Modules\HRM\Services\AppraisalRequestEvaluationService;
use Modules\HRM\Services\EmployeeServices;

class AppraisalRequestEvaluationController extends Controller
{
    protected $appraisalRequestEvaluationService;
    private $employeeService;

    public function __construct(AppraisalRequestEvaluationService $appraisalRequestEvaluationService, EmployeeServices $employeeService)
    {
        $this->appraisalRequestEvaluationService = $appraisalRequestEvaluationService;
        $this->employeeService = $employeeService;
    }

    /**
     * Show the form for creating a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function firstEvaluation(AppraisalRequest $appraisalRequest)
    {
        $evaluationQuestions = $this->appraisalRequestEvaluationService->getAllEvaluationQuestions();
        return view('hrm::appraisal.request.1st-evaluation.create',
            compact('appraisalRequest', 'evaluationQuestions'
            ));
    }

    /**
     * Storing a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @param Request $request
     * @return Response
     */
    public function firstEvaluationStore(AppraisalRequest $appraisalRequest, StoreAppraisalFirstEvaluation $request)
    {
        [$status, $result, $warningMessage] = $this->appraisalRequestEvaluationService->storeEvaluation($appraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
            if (!$result) {
                Session::flash('warning', $warningMessage);
            }
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('appraisal-request.index');
        }

        return redirect()->route('appraisal-request.second-evaluation', $appraisalRequest->id);
    }

    public function firstEvaluationEdit(AppraisalRequest $appraisalRequest, Request $request)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.1st-evaluation.edit',
            compact('appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Storing a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @param Request $request
     * @return Response
     */
    public function firstEvaluationUpdate(AppraisalRequest $appraisalRequest, Request $request)
    {
        [$status, $result, $warningMessage] = $this->appraisalRequestEvaluationService->updateEvaluation($appraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
            if (!$result) {
                Session::flash('warning', $warningMessage);
            }
        } else {
            Session::flash('error', trans('labels.save_fail'));
            return redirect()->route('appraisal-request.index');
        }

        return redirect()->route('appraisal-request.second-evaluation', $appraisalRequest->id);
    }

    public function secondEvaluationShow(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.2nd-evaluation.show',
            compact('appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));

    }


    /**
     * Show the form for creating a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function secondEvaluation(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);
        $reportingOfficers = $this->employeeService->getCROOfficer($appraisalRequest->employee_officer_id);

        return view('hrm::appraisal.request.2nd-evaluation.create',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'reportingOfficers',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @param StoreAppraisalSecondEvaluation $request
     * @return Response
     */
    public function secondEvaluationStore(AppraisalRequest $appraisalRequest, StoreAppraisalSecondEvaluation $request)
    {
        [$status, $result, $warningMessage] = $this->appraisalRequestEvaluationService->storeSummarizedEvaluation($appraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->summarizedEvaluation->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('appraisal-request.index');
    }

    public function secondEvaluationEdit(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);
        $reportingOfficers = $this->employeeService->getEmployeesWithOutRequesterDropdown();

        return view('hrm::appraisal.request.2nd-evaluation.edit',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'reportingOfficers',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function secondEvaluationUpdate(AppraisalRequest $appraisalRequest, StoreAppraisalSecondEvaluation $request)
    {
        [$status, $result, $warningMessage] = $this->appraisalRequestEvaluationService->storeSummarizedEvaluationUpdate($appraisalRequest, $request->all());

        if ($status) {
            Session::flash('success', '<span class="notificationPrint">ধন্যবাদ, আবেদনটি সফল ভাবে ' . $status->receiver->user->name .
                " এর নিকট " . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়েছে । </span><a class="badge badge-glow btn-primary" onclick="jQuery(\'.notificationPrint\').print()"> Print Now</a>');
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }
        return redirect()->route('appraisal-request.index');
    }
}
