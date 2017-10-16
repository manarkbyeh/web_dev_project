<?php

namespace App;

use App\Image;
use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gast extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    protected $cascadeDeletes = ['images'];
    protected $primaryKey = 'id';
    
    
    protected $dates = ['deleted_at'];
    
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
}