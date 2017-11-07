<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Gast;
use Session;
use Carbon\Carbon;
use Socialite;
use Cookie;
use App\Match;
use App\Period;
use Illuminate\Support\Facades\Redirect;

class GastController extends Controller {

    public function __construct() {
        $this->middleware('auth')->except('create', 'handleProviderCallback', 'redirectToProvider','store');
    }

    public function index() {
       
        $gasts = Gast::withTrashed()->get();
        return view("manageGast.index", ["gasts" => $gasts]);
    }

    public function create(Request $request) {
        $ck = isset($_COOKIE['xvz']) ? $_COOKIE['xvz'] : '';
        $ip = $request->ip();
        $gast = Gast::where('ip', $ip)
                        ->orwhere('cookies', $ck)->first();
        if ($gast != null) {
            if ($gast->ip != $ip) {
                $gast->ip = $ip;
                $gast->save();
            } elseif ($gast->cookies != $ck) {
                $mytime = Carbon::now();
                $ck = md5($mytime->toDateTimeString() . $ip);
                $gast->cookies = $ck;
                if ($gast->save()) {
                    setcookie('xvz', $ck, time() + 3600 * 24 * 30 * 12, '/');
                }
            }
            return redirect('/image');
        }
        return view('inschrijven');
    }

    public function store(Request $request) {
        $this->checkMatch();
        $ip = $request->ip();
        $mytime = Carbon::now();
        $cok = md5($mytime->toDateTimeString());

        $this->validate($request, array(
            'name' => 'required|max:255',
            'email' => 'required|email|unique:gasts,email',
            'adress' => 'required|max:255',
            'city' => 'required|max:255',
        ));

        // store in the database
        $gast = new Gast;

        $gast->name = $request->name;
        $gast->email = $request->email;
        $gast->adress = $request->adress;
        $gast->city = $request->city;
        $gast->ip = $ip;
        $gast->cookies = $cok;
        if ($gast->save()) {
            setcookie('xvz', $cok, time() + 3600 * 24 * 30 * 12, '/');
            return redirect('/image');
        }
        redirect::back()->with('errors', 'Something went wrong , try again');
    }

    private function checkMatch() {
        // Get today
        $now = Carbon::now();

        // Get today's match
        $match = Match::whereHas('periods', function($query) use ($now) {
            $query->where('start', '<=', $now)
                    ->where('end', '>', $now);
        })->first();

        if ($match == null) {
            Redirect::to('/')->send();
        } else {
            $this->idMatch = $match->id;
        }
    }

    public function delete($id) {


        $gast = Gast::withTrashed()->where('id', $id)->first();
        if ($gast != null && $gast->deleted_at == null) {
            $gast->delete();
            return "ok";
        } else {
            return "no";
        }
    }

    public function redirectToProvider() {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback() {
        $user = Socialite::driver('facebook')->user();
        $verbraucher = [
            'name' => $user->name,
            'email' => $user->email,
        ];
        $rules = [
            'name' => 'bail|required|string',
            'email' => 'bail|required|email|unique:gasts,email',
        ];
        $validator = Validator::make($verbraucher, $rules);
        if ($validator->fails()) {
            return redirect('image')->withErrors($validator);
        }
        $ip = \Request::ip();
        $mytime = Carbon::now();
        $cok = md5($mytime->toDateTimeString());

        // store in the database
        $gast = new Gast;

        $gast->name = $user->name;
        $gast->email = $user->email;
        $gast->ip = $ip;
        $gast->cookies = $cok;

        if ($gast->save()) {
            setcookie('xvz', $cok, time() + 3600 * 24 * 30 * 12, '/');
            return redirect('/image');
        }
        redirect::back()->with('errors', 'Something went wrong , try again');
    }

}
