<?php

namespace App\Http\Controllers;

use App\Services\AdminServices;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    private $adminServices;

    public function __construct(AdminServices $adminServices)
    {
        $this->adminServices = $adminServices;
    }

    public function index()
    {
        $results = $this->adminServices->findAll();
        return view('system.index', compact('results'));
    }

    public function changeValue(Request $request)
    {
        $result = $this->adminServices->findOne($request->id);
        $result->value = $request->status;
        $result->save();
        return response()->json(['code' => 200, 'success' => trans('labels.save_success', ['date' => date('d M Y, h:i A', time())])]);
    }
}
