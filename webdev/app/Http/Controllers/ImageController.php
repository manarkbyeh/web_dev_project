<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use App\Image;
use App\Gast;
use App\Like;
use App\Match;

use Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Auth;
use Excel;

class ImageController extends Controller
{
    private $idMatch = 0;

    public function index($id=0)
    {
        $this->checkMatch();
        if($id){
            $images =Image::withCount('likes')->with('gast')->where('id',$id)->get();
            $active= 'other';        
            return view("gallery", compact("images", "active"))->with('idgust', $this->checkGeust(\Request::ip()));            
        }
        $images =Image::withCount('likes')->with('gast')->get();
        $active= 'index';  
        return view("gallery", compact("images", "active"))->with('idgust', $this->checkGeust(\Request::ip()));
    }
    
 
    public function upload()
    {
        $this->checkMatch();
        if ($this->checkGeust(\Request::ip())) {
            $active= 'upload';
            return view("images.upload", compact('active'));
        }
        return redirect('/Guest/create');
    }
  
    public function store(Request $request)
    {
        $this->checkMatch();
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,bmp,jpg,png|max:5000'
        ]);
        $idGeust = $this->checkGeust($request->ip());
        if ($idGeust == false) {
            return redirect('/Guest/create');
        }
        $image = new Image();
        // dd($request);
        if ($request->hasFile('image')) :
            $image->path = $request->image->store('images');
            $image->gast_id = $idGeust;
            $image->match_id = $this->idMatch;
            $image->save();
            return redirect('/image')->with('Success', 'successfully saved');
        endif;
        return Back()->with('Errors', 'Error');
    }
    
    public function delete($id)
    {
        $idGuest = $this->checkGeust(\Request::ip());
        if ($idGuest == false) {
            return 'global';
        } else {
            $image = Image::find($id);
            if ($image->gast_id != $idGuest) {
                return 'no';
            }
            $image->delete();
            return 'ok';
        }
    }
    
    public function popular()
    {
        $this->checkMatch();
        $images =Image::withCount('likes')->orderBy('likes_count', 'desc')->get();
        $active= 'popular';
        return view("gallery", compact("images", "active"))->with('idgust', $this->checkGeust(\Request::ip()));
    }
    public function last_image()
    {
        $this->checkMatch();
        $images =Image::withCount('likes')->orderBy('created_at', 'desc')->get();
        $active= 'last_image';
        return view("gallery", compact("images", "active"))->with('idgust', $this->checkGeust(\Request::ip()));
    }
    
    private function checkGeust($ip)
    {
        $ck =isset($_COOKIE['xvz'])?$_COOKIE['xvz']:'';
        $gast =  Gast::where('ip', $ip)
        ->orwhere('cookies', $ck)->first();
        if ($gast !=null) {
            if ($gast->ip != $ip) {
                $gast->ip = $ip;
                $gast->save();
            } elseif ($gast->cookies != $ck) {
                $mytime = Carbon::now();
                $ck= md5($mytime->toDateTimeString().$ip);
                $gast->cookies = $ck;
                if ($gast->save()) {
                    setcookie('xvz', $ck, time() +  3600*24*30*12, '/');
                }
            }
            return $gast->id;
        }
        return false;
    }

    private function checkMatch()
    {
        $today = \Carbon\Carbon::today()->format('Y/m/d');
        $match = Match::where('start_at', '<=', $today)
        ->where('end_at', '>=', $today)->first();
        
        if ($match == null) {
            Redirect::to('/')->send();
        } else {
            $this->idMatch = $match->id;
        }
    }

    public function win()
    {
        $winners = Match::onlyTrashed()->where('win_image_id', '>', 0)->with(['image' => function ($query) {
            $query->with('gast');
        }])->paginate(5);
        return view("images.winImage", ["winners" =>$winners
        ]);
    }

    public function invite(Request $request)
    {
        if ($request->ajax()) {
            $ip = $request->ip();
            $ck =isset($_COOKIE['xvz'])?$_COOKIE['xvz']:'';
            $gast =  Gast::where('ip', $ip)
            ->orwhere('cookies', $ck)->first();
            if ($gast !=null) {
                if ($gast->ip != $ip) {
                    $gast->ip = $ip;
                    $gast->save();
                } elseif ($gast->cookies != $ck) {
                    $mytime = Carbon::now();
                    $ck= md5($mytime->toDateTimeString().$ip);
                    $gast->cookies = $ck;
                    if ($gast->save()) {
                        setcookie('xvz', $ck, time() +  3600*24*30*12, '/');
                    }
                }
                //validation
                $v = Validator::make($request->all(), [
                    'image_id' => 'required|exists:images,id',
                    'email' =>'required|email'
                    ]);
                
                if ($v->fails()) {
                    return "email";
                }
                $email = $request->input('email');
                $image_id =  $request->input('image_id');
                //check exist image created by guest id
                $img =  Image::where('id',$image_id)->with(['gast'=>function ($query) use ($gast) {
                    $query->where('id', $gast->id);
                }])->first();
                if ($img) {
                    $data = [
                        'name'=>$img->gast->name,
                        'path'=>$img->path,
                        'id_image'=>$img->id
                    ];
                    \Mail::send('email.invite', ['data' =>$data], function ($message) use ($img, $email) {
                        $message->from($img->gast->email, $img->gast->name);
                        $message->to($email)->subject("plz Like it");
                    });
                    return "ok";
                }
            } else {
                return 'redirect';
            }
          
           
            
           



            // return 'ok';
            // return 'redirect';
            // return 'email';
        }
    }
}
