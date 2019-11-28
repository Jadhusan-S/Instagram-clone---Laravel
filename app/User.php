<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Firstname','Lastname', 'email', 'password', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Get the posts record associated with the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
        /**
     * Get the likes record associated with the user liked post.
     */
    public function like()
    {
        return $this->hasMany('App\Like');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
