<?php

namespace App;

use App\Image;
use App\Like;
use App\User;
use App\Period;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public $fillable = [
        'title',
        'body',
        'condition',
        'user_id',
    ];
   
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }

    protected static function boot()
    {
        parent::boot();
        Match::deleting(function ($offer) {
            $offer->images()->delete();
            $offer->likes()->delete();
            $offer->periods()->delete();
        });
        
        // Match::restoring(function ($offer) {
        //        $offer->images()->restore();
        // });
    }
 
}
