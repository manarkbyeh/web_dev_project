<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gast;
use App\Like;
use App\Match;
use Carbon\Carbon;
use App\Period;

class LikeController extends Controller
{
    private $idMatch = 0;
    public function __construct()
    {
        // Get today
        $now = Carbon::now();
        
                // Get today's match
                $match = Match::whereHas('periods', function($query) use ($now){
                    $query->where('start', '<=' , $now )
                    ->where('end', '>' , $now );
                })->first();
        
        if ($match == null) {
            Redirect::to('/')->send();
        } else {
            $this->idMatch = $match->id;
        }
    }

    public function like(Request $request)
    {
        if ($request->ajax()) {
            $geust_id = $this->checkGeust($request);
            if ($geust_id == false) {
                return  'redirect';
            }
            $like = Like::where('gast_id', $geust_id)->where('image_id', $request->image_id)->first();
            if ($like == null) {
                $like = new \App\Like();
                $like->gast_id = $geust_id;
                $like->image_id =$request->image_id ;
                $like->match_id =$this->idMatch ;
                $like->save();
                return 'add';
            } else {
                $like->delete();
                return 'remove';
            }
        }
        return view('index');
    }
    private function checkGeust($request)
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
            return $gast->id;
        }
        return false;
    }
}
