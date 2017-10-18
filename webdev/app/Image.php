<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    public  $table = 'images';
    
    protected $dates = ['deleted_at'];
    protected $fillable = ['path', 'win', 'gast_id'];
    
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    public function m($id){
        return $this->hasMany('App\Like')->where('guest_id', $id);
    }
    // public function getLikeCountAttribute(){
    //     return $this->likes->count();
    // }
}