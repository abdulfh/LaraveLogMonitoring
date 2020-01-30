<?php

namespace App\Http\Controllers;

use App\Logger;
use App\Helpers\Tail;
use Illuminate\Http\Request;
use Auth;

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
        if($request->session()->has('current_line')){
            $request->session()->forget('current_line');
        }
        
        $logger = Logger::where('user_id', Auth::user()->id)->get();
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
    
        $logger = new Logger($request->all());
        $logger->user_id = Auth::user()->id;
        
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
    public function show(Request $request,Logger $logger){
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
    /**
     * Read Log.
     *
     * @param  \App\Logger  $logger
     * @return \Illuminate\Http\Response
     */
    public function readlog(Request $request,$logId)
    {
        $log = Logger::find($logId);
        $file = $log->log_path;
        $total_lines = intval(shell_exec('cat ' . escapeshellarg($file) . ' | wc -l'));
        $current_line = intval($request->session()->get('current_line')[$logId]);

        $line_total = $total_lines - $current_line;

        $lines = "";
        if($request->session()->has('current_line') && $current_line < $total_lines){
            $lines = shell_exec('tail -n'.$line_total. ' ' . escapeshellarg($file));
        }elseif(!$request->session()->has('current_line')){
            $lines = shell_exec('tail -n10 ' . escapeshellarg($file));
        }

        $lines_array = array_filter(preg_split('#[\r\n]+#', trim($lines)));

        if(count($lines_array) && $current_line < $total_lines){
            $request->session()->put('current_line', array( $logId => $total_lines));
            $array_current = array_slice($lines_array, -$line_total, $line_total, true);
            return response()->json(["status" => "success", "value" => $array_current], 200);
        }
        return response()->json(["status" => "error", "value" => "Data Not Updated"], 200);
    }

}
