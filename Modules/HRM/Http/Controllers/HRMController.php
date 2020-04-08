<?php

namespace Modules\HRM\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


class HRMController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        /*$actionTakenRequests = $this->appraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $ngActionTakenRequests = $this->ngAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
        $gcoActionTakenRequests = $this->gcoAppraisalRequestService->getFilteredRequestReceiverRequesterActionTaker();
       // dd($ngActionTakenRequests);
        $data = $this->appraisalRequestService->getDataForDashboard();
        $allRequests = $this->appraisalRequestService->getRequestsDataForDashboard();
        $ngAllRequests = $this->ngAppraisalRequestService->getRequestsDataForDashboard();
        $gcoAllRequests = $this->gcoAppraisalRequestService->getRequestsDataForDashboard();*/
        //dd($ngAllRequests);
        return view('hrm::index');

//        return view('hrm::index', compact(
//            'data',
//            'actionTakenRequests',
//            'ngActionTakenRequests',
//            'gcoActionTakenRequests',
//            'allRequests',
//            'ngAllRequests',
//            'gcoAllRequests'));
    }

    public function test(){
        return view('hrm::gazetted-cadre-officer.print.index');
    }
}
