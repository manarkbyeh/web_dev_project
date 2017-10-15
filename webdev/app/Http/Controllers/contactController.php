<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class contactController extends Controller
{
    public function postContact(Request $request)
    {
      
        try {
            Mail::send('email.email', $data, function ($message) use ($data) {
                $message->from('dailymunch1@gmail.com', 'DailyMunch');
                $message->to('myprojectantwerpen@gmail.com');
                $message->subject($data['subject']);
            });
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
