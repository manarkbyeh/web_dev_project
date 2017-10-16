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
        // $im = Image::find(8)->m(8)->first();
        // dd($im);
        
        $images =Image::with('likes')->get();
        return view("gallery", compact("images"))->with('idgust',$this->checkGeust(\Request::ip()));
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
        
        $idGeust = $this->checkGeust(\Request::ip());
        if ($idGeust == false) {
            return redirect('/Guest/create');
        }
        $image = new Image();
        if ($request->hasFile('image')) :
            $image->path = $request->image->store('images');
        endif;
        $image->guest_id = $idGeust;
        $image->save();
        return redirect('/image')->with('Success', 'successfully saved');
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
        $idGuest = $this->checkGeust(\Request::ip());
        if ($idGuest == false) {
            return 'global';
        }
        else {
            
            $image = Image::find($id);
            if($image->guest_id != $idGuest)
            return 'no';
            
            $image->delete();
            return 'ok';
        }
    }
    
    
    private function checkGeust($ip)
    {
        $gast =  Gast::where('ip', $ip)->first();
        if ($gast == null) {
            
            return false;
        }
        else
            return $gast->id;
    }
    
    
}