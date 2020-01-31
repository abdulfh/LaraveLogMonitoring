<?php

namespace App\Http\Controllers;

use App\Logger;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->session()->has('current_line')){
            $request->session()->forget('current_line');
        }
        $logger = Logger::get();
        return view('home', compact('logger'));
    }
}
