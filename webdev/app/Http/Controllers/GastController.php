<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Gast;
use Session;
use Carbon\Carbon;
use Socialite;
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
        $gasts = Gast::withTrashed()->get();
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
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    
    public function destroy($id)
    {
        $gast = Gast::withTrashed()->where('id',$id)->first();
        if($gast != null && $gast->deleted_at == null){
            $gast->delete();
            return  "ok";
        }else {
            return "no";
        }
    }
    public function restore($id)
    {
        $gast = Gast::withTrashed()->where('id',$id)->first();
        if($gast != null && $gast->deleted_at != null){
            $gast->restore();
            return  "ok";
        }else {
            return "no";
        }
    }
    /**
    * Redirect the user to the facebook authentication page.
    *
    * @return Response
    */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    
    /**
    * Obtain the user information from GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $verbraucher = [
            'name'     => $user->name,
            'email'    => $user->email,
           
          ];
  
          $rules=[
            'name' => 'bail|required|string',
            'email' => 'bail|required|email',
           
          ];
  
          $validator = Validator::make($verbraucher, $rules);
  
          if ($validator->fails()) {
              return redirect('image')->withErrors($validator);
          }
      
          $ip =  \Request::ip();
          $mytime = Carbon::now();
          $cok= md5($mytime->toDateTimeString());

            
          // store in the database
          $gast= new Gast;
          
          $gast->name =  $user->name;
          $gast->email =  $user->email;
          $gast->ip = $ip;
          $gast->cookies = $cok;

          if ($gast->save()) {
              setcookie('xvz', $cok, time() +  3600*24*30*12, '/');
              return redirect('/image');

          }
          redirect::back()->with('errors', 'Something went wrong , try again');
    }
}