<?php

namespace App\Http\Controllers;

use App\Services\SystemConfigService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SystemConfigController extends Controller
{
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    public function index()
    {
        $results = $this->systemConfigService->findAll();
        return view('system.config.index', compact('results'));
    }

    public function store(Request $request)
    {
        $status =  $this->systemConfigService->saveUpdatedValues($request);
        if($status){
            Session::flash('success', 'Successfully Updated.');
        }else{
            Session::flash('error', 'Update Failed.');
        }

        return redirect()->route('system-config.index');
    }
}
