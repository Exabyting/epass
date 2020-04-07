<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\HRM\Entities\NGAppraisalRequest;
use Modules\HRM\Services\AppraisalRequestApprovalService;
use Modules\HRM\Services\AppraisalRequestEvaluationService;
use Modules\HRM\Services\NGAppraisalRequestApprovalService;
use Modules\HRM\Services\NGAppraisalRequestEvaluationService;

class NGAppraisalRequestApprovalController extends Controller
{
    protected $ngAppraisalRequestEvaluationService;
    protected $ngAppraisalRequestApprovalService;

    public function __construct
    (
        NGAppraisalRequestEvaluationService $ngAppraisalRequestEvaluationService,
        NGAppraisalRequestApprovalService $ngAppraisalRequestApprovalService
    )
    {
        $this->ngAppraisalRequestEvaluationService = $ngAppraisalRequestEvaluationService;
        $this->ngAppraisalRequestApprovalService = $ngAppraisalRequestApprovalService;
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
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @return Response
     */
    public function create(NGAppraisalRequest $ngAppraisalRequest)
    {
        $primaryTable = [];
        $specialTable = [];
        $optionalTable = [];
        $evaluationQuestions = [];

        list($primaryTable, $specialTable, $optionalTable, $evaluationQuestions) = $this->ngAppraisalRequestEvaluationService->prepareEvaluationTable($ngAppraisalRequest);

        return view('hrm::non-gazetted.request.final.create',
            compact(
                'ngAppraisalRequest',
                'evaluationQuestions',
                'primaryTable',
                'specialTable',
                'optionalTable'
            ));
    }

    /**
     * Store a newly created resource in storage.
     * @param NGAppraisalRequest $ngAppraisalRequest
     * @param Request $request
     * @return Response
     */
    public function store(NGAppraisalRequest $ngAppraisalRequest, Request $request)
    {
        $status = $this->ngAppraisalRequestApprovalService->saveRequest($ngAppraisalRequest, $request->all());
        if ($status) {
            Session::flash('success', trans('labels.save_success', ['date' => date('d-m-Y', time())]));
        } else {
            Session::flash('error', trans('labels.save_fail'));
        }
        return redirect()->route('ng-appraisal-request.action-list');
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
