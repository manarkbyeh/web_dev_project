<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Image;
//use DB;
use App\Winner;
use App\Gast;
use App\Like;
use App\Match;
use App\Period;
use Mail;
use Excel;
use App\User;
class CronJob extends Command
{
      /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CronJob:cronjob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User Name Change Successfully';

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
               
        //  $this->info('hhhhh');
		//  $this->sendExcelSheet();
		  //return $end;*/
        // active period start today
        // if($todayPeriod = Period::where('start', '<=', Carbon::now())->where('end', '>', Carbon::now())->first()){
        //     Period::where('id', $todayPeriod->id)->update(['active' => 1]);
        //     Period::where('id', '<>',  $todayPeriod->id)->update(['active' => 0]);
        // }
      
        

        
        // Start check winners of today period.
        // if($ifMatch = Period::whereDate('end', '<', Carbon::now())->first()){
        
        //     // Check old  match winner
        //     $m = Period::where('win_image_id', 0)->first();

        //     if (count($m)) {

        //         // Get all image with countLikes
        //         $images =Image::where('match_id', '=', $m->match_id)
        //         ->with('gast')
        //         ->withCount('likes')
        //         ->orderBy('likes_count', 'desc')
        //         ->get();
         
        //         //get max like
        //         if (count($images)) {
                    
        //             // Get winner if have max likes and random if exist more guest have same likes
        //             $winner = $this->getWinner($images);


        //             // Get match
        //             $match = $this->updateForMatchMetaData($m,$winner);
                  

        //             if($match != false){
		// 			 // Send email for admin about winner
		// 			$this->sendMailToAdminForWinnerReport($match, $winner);

        //             }                  

        //         }
        //     }
            
        // }
  
    }
    protected function sendMailToAdminForWinnerReport($match, $winner)
    {
        
        $image = Image::where('id', $winner)->first();
        $admin = User::where('id', 1)->first();
        $winner = Gast::where('id', $image->gast_id)->first();
        
        if ($match->win_image_id > 0) {
          $v =   \Mail::send('email.guestWinner', ['Gast' => $winner], function ($message) use ($winner, $match, $admin) {
                $message->from('mdke@ymail.com', 'Admin1');
                $message->to($winner->email, $winner->name)->subject($match->title)->cc($admin->email);
            });
         
            Image::where('deleted_at', null)->delete();
        } else {
            \Mail::send('email.noWinner', ['Gast' => $winner], function ($message) use ($winner, $match, $admin) {
                $message->from('mdke@ymail.com', 'Admin');
                $message->to($admin->email)->subject($match->title);
            });
        }
    }

    protected function getWinner($images)
    {
        $max_likes = $images[0]->likes_count;

        $winner = $images->where('likes_count', $max_likes)->random();
        if ($winner->count()) {
            $winnerId =  $winner->id;
        } else {
            $winnerId =  -1;
        }
        return $winnerId;
    }

    protected function updateForMatchMetaData($m,$winnerId) 
    {

        
        $match = Period::where('match_id', $m->match_id)->where('win_image_id', 0)->first();

        if($match->end < Carbon::now()){
            $match->win_image_id = $winnerId;
            $match->save();
            //Image::where('deleted_at', null)->delete();
            Like::where('deleted_at', null)->delete();
            return $match;
        }else{
            return false;
        }
    }


    function sendExcelSheet()
    {
      
          //Gget new guests
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
              $admin = User::where('id', 1)->first();
              \Mail::send('email.newUsers', [], function ($message) use ($file,  $admin) {
                  $message->from( $admin->email, 'Admin');
                  $message->to( $admin->email, $admin->name )->subject('New Users');
                  $message->attach($file->store("xlsx", false, true)['full']);
              });
          }
  
    }
}
