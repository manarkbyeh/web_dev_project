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
use Auth;
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
            return view("gallery", compact("images"))->with('idgust',$this->checkGeust(\Request::ip()));
    }
    
 
    public function upload()
    {
    
        if ($this->checkGeust(\Request::ip())) {
            $active= 'upload';
            return view("images.upload", compact('active'));
        }
        return redirect('/Guest/create');
    }
  
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,bmp,jpg,png|max:5000'
        ]);
        $idGeust = $this->checkGeust($request->ip());
        if ($idGeust == false) {
            return redirect('/Guest/create');
        }
        $image = new Image();
        // dd($request);
        if ($request->hasFile('image')) :
            $image->path = $request->image->store('images');
            $image->gast_id = $idGeust;
            $image->save();
            return redirect('/image')->with('Success', 'successfully saved');
        endif;
        return Back()->with('Errors', 'Error');
    }
 
    
    
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
    
    
    private function checkGeust($ip){
        $ck =isset($_COOKIE['xvz'])?$_COOKIE['xvz']:'';
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