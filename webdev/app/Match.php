<?php

namespace App;

use App\Image;
use App\Like;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image()
    {
        return $this->belongsTo('App\Image', 'win_image_id')->onlyTrashed();
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    protected static function boot()
    {
        parent::boot();
        Match::deleting(function ($offer) {
            $offer->images()->delete();
            $offer->likes()->delete();
        });
        
        // Match::restoring(function ($offer) {
        //        $offer->images()->restore();
        // });
    }
}
