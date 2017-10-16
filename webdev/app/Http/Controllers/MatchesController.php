<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use  App\Match;

class MatchesController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $match = Match::orderBy('id', 'desc')->first();
        return view("index",["match"=>$match]);
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('home.create');
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
        'title'         => 'required|max:255',
        'voorwaarden'   => 'required',
        'body'          => 'required',
        'start_at'         => 'required',
        'end_at'         => 'required',
        ));
        
        $matches = new Match();
        
        
        $matches->title = $request->title;
        $matches->body = $request->body;
        $matches->start_at = $request->start_at;
        $matches->end_at = $request->end_at;
        $matches->voorwaarden = $request->voorwaarden;
        
        if (   $matches->save()) {
            
            session()->flash('success','Article added successfuly !!');
            return redirect('/');
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