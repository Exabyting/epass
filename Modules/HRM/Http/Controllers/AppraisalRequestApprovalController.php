<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\AppraisalRequest;
use Modules\HRM\Services\AppraisalRequestApprovalService;
use Modules\HRM\Services\AppraisalRequestEvaluationService;

class AppraisalRequestApprovalController extends Controller
{
    protected $appraisalRequestEvaluationService;
    protected $appraisalRequestApprovalService;

    public function __construct
    (
        AppraisalRequestEvaluationService $appraisalRequestEvaluationService,
        AppraisalRequestApprovalService $appraisalRequestApprovalService
    )
    {
        $this->appraisalRequestEvaluationService = $appraisalRequestEvaluationService;
        $this->appraisalRequestApprovalService = $appraisalRequestApprovalService;
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
     * @param AppraisalRequest $appraisalRequest
     * @return Response
     */
    public function create(AppraisalRequest $appraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->appraisalRequestEvaluationService->prepareEvaluationTable($appraisalRequest);

        return view('hrm::appraisal.request.final.create',
            compact(
                'appraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    public function store(AppraisalRequest $appraisalRequest, Request $request)
    {
        $status = $this->appraisalRequestApprovalService->saveRequest($appraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d-m-Y', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('appraisal-request.action-list');
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
