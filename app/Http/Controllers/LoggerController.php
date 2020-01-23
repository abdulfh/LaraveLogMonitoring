<?php

namespace App\Http\Controllers;

use App\Logger;
use Illuminate\Http\Request;

class LoggerController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logger = Logger::get();
        $num = 1;
        return view('logger.index',compact('logger','num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logger.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'log_name' => 'required',
            'log_path' => 'required|regex:/^.+\.log$/'
        ]);
    
        $logger = Logger::create($request->all());
        
        if($logger->save()){
            return redirect()->route('logger.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function show(Logger $logger){
        return view('logger.show', compact('logger'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function edit(Logger $logger){
        return view('logger.edit', compact('logger'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logger $logger){

        $this->validate($request,[
            'log_name' => 'required',
            'log_path' => 'required|regex:/^.+\.log$/'
        ]);
    
        $update = $logger->update($request->all());
        
        if($update){
            return redirect()->route('logger.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logger $logger)
    {
        $logger->delete();
        return redirect()->route('logger.index');
    }
}
