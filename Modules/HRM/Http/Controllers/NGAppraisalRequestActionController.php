<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\NGAppraisalRequest;
use Modules\HRM\Http\Requests\StoreEvaluationAction;
use Modules\HRM\Services\NGAppraisalRequestEvaluationService;

class NGAppraisalRequestActionController extends Controller
{
    protected $ngAppraisalRequestEvaluationService;

    public function __construct(NGAppraisalRequestEvaluationService $ngAppraisalRequestEvaluationService)
    {
        $this->ngAppraisalRequestEvaluationService = $ngAppraisalRequestEvaluationService;
    }

    public function index()
    {
        $actions = $this->ngAppraisalRequestEvaluationService->getAllApprovedEvaluationAction();
        return view('hrm::non-gazetted.request.action.index', compact('actions'));
    }

    /**
     * Display a listing of the resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function action(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);
        return view('hrm::non-gazetted.request.action.create',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionEdit(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);
        return view('hrm::non-gazetted.request.action.edit',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param StoreEvaluationAction $request
     * @return Response
     */
    public function storeAction(NGAppraisalRequest $ngAppraisalRequest, StoreEvaluationAction $request)
    {
        $status = $this->ngAppraisalRequestEvaluationService->requestAction($ngAppraisalRequest, $request->all());

        if ($status) {
            if ($request->action == 'Approve') {
                Session::flash('success', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' অনুমোদিত হয়েছে');
            } elseif ($request->action == 'Reject') {
                Session::flash('error', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রত্যাখ্যাত হয়েছে');
            } else if ($request->action == 'Save') {
                Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
                return redirect()->route('ng-appraisal-request.action-edit', compact('ngAppraisalRequest'));
            }
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('ng-appraisal-request.index');
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionView(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.request.action.show',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }


    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function evaluatedFormPrint(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.print.evaluated.index',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function evaluatedFormPrintPreview(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.print.evaluated.print-preview',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrint(ngAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.print.index',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrintPreview(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.print.print-preview',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }
}
