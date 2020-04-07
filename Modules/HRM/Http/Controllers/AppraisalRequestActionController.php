<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalRequest;
use Modules\HRM\Http\Requests\StoreEvaluationAction;
use Modules\HRM\Services\AppraisalRequestEvaluationService;

class AppraisalRequestActionController extends Controller
{
    protected $appraisalRequestEvaluationService;

    public function __construct(AppraisalRequestEvaluationService $appraisalRequestEvaluationService)
    {
        $this->appraisalRequestEvaluationService = $appraisalRequestEvaluationService;
    }


    public function index()
    {
        $actions = $this->appraisalRequestEvaluationService->getAllApprovedEvaluationAction();
        return view('hrm::appraisal.request.action.index', compact('actions'));
    }

    /**
     * Display a listing of the resource.
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function action(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);
        return view('hrm::appraisal.request.action.create',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function actionEdit(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);
        return view('hrm::appraisal.request.action.edit',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param AppraisalRequest $appraisalRequest
     * @param Request $request
     * @return Response
     */
    public function storeAction(AppraisalRequest $appraisalRequest, StoreEvaluationAction $request)
    {
        $status = $this->appraisalRequestEvaluationService->requestAction($appraisalRequest, $request->all());

        if ($status) {
            if ($request->action == 'Approve') {
                Session::flash('success', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' অনুমোদিত হয়েছে');
            } elseif ($request->action == 'Reject') {
                Session::flash('error', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রত্যাখ্যাত হয়েছে');
            } else if ($request->action == 'Save') {
                Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
                return redirect()->route('appraisal-request.action-edit', compact('appraisalRequest'));
            }
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('appraisal-request.index');
    }

    public function actionView(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.action.show',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function formPrint(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.action.print',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function formPrintPreview(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.action.print-preview',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function evaluatedFormPrint(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.action.evaluated-form-print',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function evaluatedFormPrintPreview(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.action.evaluated-form-print-preview',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }
}
