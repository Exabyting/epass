<?php

namespace App\Http\Controllers;

use App\Services\Notification\AppNotificationService;
use Nwidart\Modules\Facades\Module;

class HomeController extends Controller
{
    private $appNotificationService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AppNotificationService $appNotificationService)
    {
        $this->middleware('auth');
        $this->appNotificationService = $appNotificationService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    dd("hello");
        return redirect()->route('hrm');
        // return view('home');
    }
    public function shutdown()
    {
         return view('errors.999');
    }

    public function landing()
    {
	    return redirect()->route('hrm');

//        $notifications = $this->appNotificationService->getUnreadNotifications();
//        $modules = array_keys(Module::all());
//        return view('welcome', compact('modules','notifications'));
    }

}
