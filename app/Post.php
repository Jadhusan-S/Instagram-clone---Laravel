<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
