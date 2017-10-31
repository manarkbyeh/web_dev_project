<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Match;
use Carbon\Carbon;
use App\Image;
use DB;
use App\Winner;
use App\Gast;
use App\Like;
use App\Period;
use Mail;
use Excel;

class HomeController extends Controller
{
    
     
    public function index()
    {
        // Get today
        $now = Carbon::now();
        
                // Get today's match
                $match = Match::whereHas('periods', function($query) use ($now){
                    $query->where('start', '<=' , $now )
                    ->where('end', '>' , $now );
                })->first();
          
                // Get Match winners and Image and gast
                $winners = Period::where('win_image_id', '>', 0)->with(['image' => function ($query) {
                    $query->with('gast');
                }])->limit(5)->get();
            
        
                return view("index", compact('match', 'winners'));
    }
    public function test()
    {
        //get new guests
         $today = \Carbon\Carbon::today()->format('Y/m/d');
        $export = Gast::select('id', 'name', 'email', 'created_at')
        ->where('created_at', '>=', $today)
        ->get();
        if ($export->count()) {
            //create exel file and send it
            $file_name = 'New Users.'. md5(\Carbon\Carbon::now());
            $file =  Excel::create($file_name, function ($excel) use ($export) {
                $excel->sheet('Sheet 1', function ($sheet) use ($export) {
                    $sheet->fromArray($export);
                });
            });
            $match = Match::first();
            \Mail::send('email.newUsers', [], function ($message) use ($file, $match) {
                $message->from($match->user->email, 'Admin');
                $message->to($match->user->email, $match->user->name )->subject('New Users');
                $message->attach($file->store("csv", false, true)['full']);
            });
        }

        //check old  match winner
        $m = Match::where('win_image_id', 0)
        ->where('end_at', '<=', $today)
        ->first();
        if ($m->count()) {
            //get all image with countLikes
            $images =Image::where('match_id', $m->id)
            ->with('gast')
            ->withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->get();
            //get max like
            if ($images->count()) {
                $max_likes = $images[0]->likes_count;
                //get winner if have max likes and random if exist more guest have same likes
                $winner = $images->where('likes_count', $max_likes)->random();
                if ($winner->count()) {
                    $winnerId =  $winner->id;
                } else {
                    $winnerId =  -1;
                }
                    $match = Match::where('id', $m->id)->with('user')->first();
                    $match->win_image_id = $winnerId;
                    // $match->deleted_at = \Carbon\Carbon::now();
                    $match->save();
                    Image::where('deleted_at', null)->delete();
                    Like::where('deleted_at', null)->delete();
                //    //get email winner and name for send it to admin and guest
              
                if ($winnerId>0) {
                    \Mail::send('email.guestWinner', ['Gast' =>$winner->gast], function ($message) use ($winner, $match) {
                        $message->from($match->user->email, 'Admin');
                        $message->to($winner->gast->email, $winner->gast->name)->subject($match->title)->cc($match->user->email);
                    });
                } else {
                    \Mail::send('email.noWinner', ['Gast' =>$winner->gast], function ($message) use ($winner, $match) {
                        $message->from('Admin@team.com', 'Admin');
                        $message->to($match->user->email)->subject($match->title);
                    });
                }
            }
        }
    }
}
