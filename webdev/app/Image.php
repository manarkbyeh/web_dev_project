<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}