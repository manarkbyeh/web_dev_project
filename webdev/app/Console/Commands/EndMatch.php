<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Image;
use DB;
use App\Winner;
use App\Gast;
use Mail;

class EndMatch extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:match';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'end of the match and set the winner';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $imgs =  DB::table('images')
                    ->join('likes', 'images.id', '=', 'likes.image_id')
                    ->groupBy('likes.image_id')
                    ->orderBy( \DB::raw('COUNT(likes.image_id)'),'desc')
                    ->select('images.*')
                    ->first();
                    
        $like_count = DB::table('likes')->where('image_id', '=', $imgs->id)->count();
     
        $data = [
          'image_id' => $imgs->id, 'likes_count' => $like_count,
          'guest_id' => $imgs->guest_id
        ];

        $winners = Winner::create($data);
        $Gast = Gast::find($imgs->guest_id)->toArray();
        try{
            Mail::send('email.email',  ['Gast' => $Gast],function($message) use ( $Gast){
                $message->from('dailymunch1@gmail.com');
                $message->to('dailymunch1@gmail.com');
                $message->subject('hello');
            });
        }catch(\Exception $e){
            throw $e;
        }

    }
}
