<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winner extends Model
{
    protected $primaryKey = 'id';
    public  $table = 'winners';

    protected $fillable = ['image_id', 'guest_id', 'likes_count'];

}
