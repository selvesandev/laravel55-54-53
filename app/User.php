<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function favourite()
    {
        return $this->belongsToMany(Post::class, 'favourites');
    }

    public function notificationToSlack()
    {
        //Make this dynamic
        return 'https://hooks.slack.com/services/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';
    }
}
