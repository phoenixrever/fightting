<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['isShow','body'];

    public function blog()
    {
        return $this->belongsTo('App\Http\Models\Blog')->withDefault([
            'name' => '游客',
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User')->withDefault([
            'name' => '游客',
        ]);
    }

    public function replyComments()
    {
        return $this->hasMany('App\Http\Models\ReplyComment');
    }
}
