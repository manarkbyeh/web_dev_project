<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Image;


class HomeController extends Controller {

    public function index() {
        // Get today
        $now = Carbon::now();

        // Get today's match
        $match = Match::whereHas('periods', function($query) use ($now) {
                    $query->where('start', '<=', $now)
                            ->where('end', '>', $now);
                })->first();
        $period = Period::where('start', '<=', Carbon::now())->where('end', '>', Carbon::now())->first();
        // Get Match winners a+nd Image and gast
        $winners = Period::where('win_image_id', '>', 0)->with(['image' => function ($query) {
                        $query->with('gast');
                    }])->limit(5)->get();

        return view("index", compact('match', 'winners', 'period'));
    }


}
