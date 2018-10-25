<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = ['title','body'];

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User')->withDefault([
            'name' => '游客',
        ]);
    }
    public function comments()
    {
        return $this->hasMany('App\Http\Models\Comment');
    }
}
