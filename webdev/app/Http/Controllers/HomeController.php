<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;

class HomeController extends Controller
{
    
    public function index()
    {
        //get match = today
        $today = \Carbon\Carbon::today()->format('Y/m/d');
        $match = Match::where('start_at', '<=', $today)
        ->where('end_at', '>=', $today)->first();
        //get Match win and Image and gast
        $winners = Match::onlyTrashed()->where('win_image_id', '>', 0)->with(['image' => function ($query) {
                $query->with('gast');
        }])->paginate(5);

        return view("index", [
            "match"=>$match,
            "winners" =>$winners
            ]);
    }
}
