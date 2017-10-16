<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gast;
use Session;
use Carbon\Carbon;

use Cookie;

class GastController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $gasts = Gast::all();
        return view("manageGast.index", ["gasts"=>$gasts]);
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {
        $ck =isset($_COOKIE['xvz'])?$_COOKIE['xvz']:'';
        $ip = $request->ip();
        $gast =  Gast::where('ip', $ip)
        ->orwhere('cookies', $ck)->first();
        if ($gast !=null) {
            if ($gast->ip != $ip) {
                $gast->ip = $ip;
                $gast->save();
            } elseif ($gast->cookies != $ck) {
                $mytime = Carbon::now();
                $ck= md5($mytime->toDateTimeString().$ip);
                $gast->cookies = $ck;
                if ($gast->save()) {
                    setcookie('xvz', $ck, time() +  3600*24*30*12, '/');
                }
            }
            return redirect('/image');
        }
        return view('inschrijven');
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $ip =  $request->ip();
        $mytime = Carbon::now();
        $cok= md5($mytime->toDateTimeString());
        
        $this->validate($request, array(
        'name'         => 'required|max:255',
        'email'          => 'required|unique:gasts'
        ));
        
        // store in the database
        $gast= new Gast;
        
        $gast->name = $request->name;
        $gast->email = $request->email;
        $gast->ip = $ip;
        $gast->cookies = $cok;
        if ($gast->save()) {
            setcookie('xvz', $cok, time() +  3600*24*30*12, '/');
            return redirect('/image');
        }
        redirect::back()->with('errors', 'Something went wrong , try again');
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
    
    public function delete($id)
    {
        $gast=  Gast::find($id);
        $gast->delete();
        
        
        return  "";
    }
}