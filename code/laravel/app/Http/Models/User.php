<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use Notifiable,HasRoles,SearchableTrait;

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


    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.name' => 10,
            'users.email' => 5,
            'users.updated_at' => 2,
            'blogs.title' => 2,
            'blogs.body' => 1,
        ],
        'joins' => [
            'blogs' => ['blogs.id','users.id'],
        ],
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    public function blogs()
    {
        return $this->hasMany('App\Http\Models\Blog')->withDefault([
            'name' => '游客',
        ]);
    }
    public function comments()
    {
        return $this->hasMany('App\Http\Models\Comment')->withDefault([
            'name' => '游客',
        ]);
    }
    public function replyComments()
    {
        return $this->hasMany('App\Http\Models\ReplyComment')->withDefault([
            'name' => '游客',
        ]);
    }
}
