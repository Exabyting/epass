<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\GCOAppraisalRequest;
use Modules\HRM\Http\Requests\StoreEvaluationAction;
use Modules\HRM\Services\GCOAppraisalRequestEvaluationService;

class GCOAppraisalRequestActionController extends Controller
{
    protected $gcoAppraisalRequestEvaluationService;

    public function __construct(GCOAppraisalRequestEvaluationService $gcoAppraisalRequestEvaluationService)
    {
        $this->gcoAppraisalRequestEvaluationService = $gcoAppraisalRequestEvaluationService;
    }

    public function index()
    {

        $actions = $this->gcoAppraisalRequestEvaluationService->getAllApprovedEvaluationAction();
        return view('hrm::gazetted-cadre-officer.request.action.index', compact('actions'));
    }

    /**
     * Display a listing of the resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function action(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];


        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.request.action.create',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionEdit(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.request.action.edit',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }

    /**
     * Show the form for creating a new resource.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param StoreEvaluationAction $request
     * @return Response
     */
    public function storeAction(GCOAppraisalRequest $gcoAppraisalRequest, StoreEvaluationAction $request)
    {
        $status = $this->gcoAppraisalRequestEvaluationService->requestAction($gcoAppraisalRequest, $request->all());

        if ($status) {
            if ($request->action == 'Approve') {
                Session::flash('success', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' অনুমোদিত হয়েছে');
            } elseif ($request->action == 'Reject') {
                Session::flash('error', 'ধন্যবাদ, আবেদনটি সফলভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রত্যাখ্যাত হয়েছে');
            } else if ($request->action == 'Save') {
                Session::flash('success', trans('labels.save_success', ['date' => date('d M Y, h:i A', time())]));
                return redirect()->route('gco-appraisal-request.action-edit', compact('gcoAppraisalRequest'));
            }
        } else {
            Session::flash('error', 'ত্রুটি, আবেদনটি সফল ভাবে ' . date('d M Y, h:i A', time()) . ' এ প্রেরিত হয়নি');
        }

        return redirect()->route('gco-appraisal-request.index');
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function actionView(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];


        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.request.action.show',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }


    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function evaluatedFormPrint(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.print.evaluated.index',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function evaluatedFormPrintPreview(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.print.evaluated.print-preview',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrint(gcoAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.print.index',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }

    /**
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrintPreview(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);

        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.print.print-preview',
            compact(
                'gcoAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable',
                'totalRating'
            ));
    }
}
