<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use  App\Match;

class MatchesController extends Controller
{
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
        
      
        $matches = Match::withTrashed()->get();
        return view("home.index", ["matches"=>$matches]);
        
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
        
        'title'          => 'required',
        'body'          => 'required',
        'conditions'          => 'required',
        'start_at'         => 'required',
        'end_at'         => 'required',
        ));
        
        $matches = new Match();
        $matches->title = $request->title;
        $matches->body = $request->body;
        $matches->condition = $request->conditions;
        $matches->start_at = $request->start_at;
        $matches->end_at = $request->end_at;
        
        
        if (   $matches->save()) {
            
            session()->flash('success','Article added successfuly !!');
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
        
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $match = Match::find($id);
        
        return view('home.edit')->withMatch($match);
        
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
        
        
        
        $this->validate($request, array(
        
        'title'          => 'required',
        'body'          => 'required',
        'conditions'          => 'required',
        'start_at'         => 'required',
        'end_at'         => 'required',
        ));
        // Validate the data
        $match = Match::find($id);
        $match->title = $request->input('title');
        $match->body = $request->input('body');
        $match->condition = $request->input('condition');
        $match->start_at = $request->input('start_at');
        $match->end_at = $request->input('end_at');
        
        
        
        if (   $match->save()) {
            
            session()->flash('success','Article edited successfuly !!');
            return redirect('/match');
        }
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
        $match = Match::withTrashed()->where('id',$id)->first();
        if($match != null && $match->deleted_at == null){
            $match->delete();
            return  "ok";
        }else {
            return "no";
        }
    }
    public function restore($id)
    {
        $match = Match::withTrashed()->where('id',$id)->first();
        if($match != null && $match->deleted_at != null){
            $match->restore();
            return  "ok";
        }else {
            return "no";
        }
    }
}