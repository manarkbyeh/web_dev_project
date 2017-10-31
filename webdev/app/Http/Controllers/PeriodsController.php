<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Period;
use App\Match;

class PeriodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $periods = Period::where('match_id', '=', $id)->get();
        $match = Match::where('id', '=', $id)->first();
  
        return view("periods.index", ["periods"=>$periods, "match"=>$match]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
     
        
        $this->validate($request, array(
            'title'          => 'required',

            'start'       => 'required|date|after_or_equal:'.\Carbon\Carbon::today(),
            'end'         => 'required|date|after_or_equal:start_at',
            ));
   
            $res =  Period::whereBetween('start', [$request->start, $request->end])
            ->orWhereBetween('end', [$request->start, $request->end])
            ->count();
            if ($res >0) {
                return back()->withInput()->withErrors(['Deze match bestaat al']);
        }
            $Period = new Period();
            $Period->title = $request->title;
            $Period->start = $request->start;
            $Period->end = $request->end;
            $Period->match_id = $request->match_id;
       
            
          
   
         
            if ($Period->save()) {
             
    
                session()->flash('success', 'Article added successfuly !!');
                return redirect('/match');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
