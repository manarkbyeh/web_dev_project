<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Period extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $fillable = [
        'title',
        'start',
        'end'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function match()
    {
        return $this->belongTo(Match::class);
    }
    public function image()
    {
        return $this->belongsTo('App\Image', 'win_image_id')->onlyTrashed();
    }
}
