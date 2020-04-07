<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\GCOAppraisalRequest;
use Modules\HRM\Services\GCOAppraisalRequestApprovalService;
use Modules\HRM\Services\GCOAppraisalRequestEvaluationService;

class GCOAppraisalRequestApprovalController extends Controller
{
    protected $gcoAppraisalRequestEvaluationService;
    protected $gcoAppraisalRequestApprovalService;

    public function __construct
    (
        GCOAppraisalRequestEvaluationService $gcoAppraisalRequestEvaluationService,
        GCOAppraisalRequestApprovalService $gcoAppraisalRequestApprovalService
    )
    {
        $this->gcoAppraisalRequestEvaluationService = $gcoAppraisalRequestEvaluationService;
        $this->gcoAppraisalRequestApprovalService = $gcoAppraisalRequestApprovalService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('hrm::index');
    }

    /**
     * Show the form for creating a new resource.
     * @param GCOAppraisalRequest $gcoAppraisalRequest
     * @return Response
     */
    public function create(GCOAppraisalRequest $gcoAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->gcoAppraisalRequestEvaluationService->prepareEvaluationTable($gcoAppraisalRequest);
        $totalRating= $this->gcoAppraisalRequestEvaluationService->getTotalRating($primaryTable, $specialTable);
        return view('hrm::gazetted-cadre-officer.request.final.create',
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
     * Store a newly created resource in storage.
     * @param GCOAppraisalRequest $gcoAppraisalRequest
     * @param Request $request
     * @return Response
     */
    public function store(GCOAppraisalRequest $gcoAppraisalRequest, Request $request)
    {
        $status = $this->gcoAppraisalRequestApprovalService->saveRequest($gcoAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d-m-Y', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('gco-appraisal-request.action-list');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('hrm::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('hrm::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
