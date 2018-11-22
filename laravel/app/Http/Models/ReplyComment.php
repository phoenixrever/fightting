<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{

    protected $fillable = ['isShow','reply_to','reply_to_name','body'];

    public function comment()
    {
        return $this->belongsTo('App\Http\Models\Comment')->withDefault([
            'name' => '游客',
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\Http\Models\User')->withDefault([
            'name' => '游客',
        ]);
    }
}
