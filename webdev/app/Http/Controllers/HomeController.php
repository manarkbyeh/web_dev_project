<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;

class HomeController extends Controller
{
    
    public function index()
    {
        $today = \Carbon\Carbon::today()->format('Y/m/d');
        $match = Match::where('start_at','>=',$today)
        ->where('end_at','>=',$today)->first();
    
        return view("index",["match"=>$match]);
    }
}
