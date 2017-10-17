<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Carbon\Carbon;
use App\Image;
use DB;

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
       $now=Carbon::now();
       echo $now->toDateTimeString();
       DB::table('images')->delete();
    }
}
