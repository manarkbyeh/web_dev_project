<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use  App\Match;

class HomeController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        $match = Match::orderBy('id', 'desc')->first();
        return view("index",["match"=>$match]);
    }
    
    
}