<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function m($id){
        return $this->hasMany('App\Like')->where('gast_id', $id);
    }
    protected static function boot()
    {
        parent::boot();
    
        Image::deleting(function ($offer) {
            $offer->likes()->delete();
         });
    
         Image::restoring(function ($offer) {
               $offer->likes()->restore();
        });
    }
}