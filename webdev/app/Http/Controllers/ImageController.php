<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use App\Image;
use App\Gast;
use App\Like;

use Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;


class ImageController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $images =Image::with('likes')->get();
        return view("gallery",compact("images"));
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
        $idGeust = $this->checkGeust($request);
        if($idGeust == false){
            return redirect('/Guest/create');
        }
        $image = new Image();
        
        if($request->hasFile('image')):
        $image->path = $request->image->store('images');
        endif;
        $image->guest_id= $idGeust;
        $image->save();
        return redirect('/image')->with('Success','successfully saved');
        
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
    public function destroy(Request $request,$id)
    {
        if($request->ajax()){
            $idGuest = $this->checkGeust($request);
            if($idGeust == false){
                return false;
            }else{
                $image = Image::find($id);
                $image->delete();
                return true;
            }
        }
        redirect('/');
    }
    
    
    private function checkGeust($request){
        $ck =isset($_COOKIE['xvz'])?$_COOKIE['xvz']:'';
        $ip = $request->ip();
        $gast =  Gast::where('ip',$ip)
        ->orwhere('cookies',$ck)->first();
        if($gast !=null){
            if($gast->ip != $ip){
                $gast->ip = $ip;
                $gast->save();
            }else if($gast->cookies != $ck){
                $mytime = Carbon::now();
                $ck= md5($mytime->toDateTimeString().$ip);
                $gast->cookies = $ck;
                if($gast->save() ){
                    setcookie('xvz', $ck, time() +  3600*24*30*12, '/');
                }
            }
            return $gast->id;
        }
        return false;
    }
}