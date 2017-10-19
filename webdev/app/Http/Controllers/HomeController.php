<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $match = Match::orderBy('id', 'desc')->first();
        return view("index",["match"=>$match]);
    }
}
