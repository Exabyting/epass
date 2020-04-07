<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\HRM\Services\AppraisalRequestService;
use Modules\HRM\Services\NGAppraisalRequestService;
use Modules\HRM\Services\GCOAppraisalRequestService;

class HRMController extends Controller
{
    private $appraisalRequestService;
    private $ngAppraisalRequestService;
    private $gcoAppraisalRequestService;


    /**
     * HRMController constructor.
     * @param AppraisalRequestService $appraisalRequestService
     * @param NGAppraisalRequestService $ngAppraisalRequestService
     */
    public function __construct
    (
        AppraisalRequestService $appraisalRequestService,
        NGAppraisalRequestService $ngAppraisalRequestService,
        GCOAppraisalRequestService $gcoAppraisalRequestService
    )
    {
        $this->appraisalRequestService = $appraisalRequestService;
        $this->ngAppraisalRequestService = $ngAppraisalRequestService;
        $this->gcoAppraisalRequestService = $gcoAppraisalRequestService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $actionTakenRequests = $this->appraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $ngActionTakenRequests = $this->ngAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $gcoActionTakenRequests = $this->gcoAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
       // dd($ngActionTakenRequests);
        $data = $this->appraisalRequestService->getDataForDashboard();
        $allRequests = $this->appraisalRequestService->getRequestsDataForDashboard();
        $ngAllRequests = $this->ngAppraisalRequestService->getRequestsDataForDashboard();
        $gcoAllRequests = $this->gcoAppraisalRequestService->getRequestsDataForDashboard();
        //dd($ngAllRequests);


        return view('hrm::index', compact(
            'data',
            'actionTakenRequests',
            'ngActionTakenRequests',
            'gcoActionTakenRequests',
            'allRequests',
            'ngAllRequests',
            'gcoAllRequests'));
    }

    public function test(){
        return view('hrm::gazetted-cadre-officer.print.index');
    }
}
