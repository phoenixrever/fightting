<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Models\User;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static function permissions_select()
    {
        if(Auth::check()){
            $permissions_select=User::find(Auth::id())->permissions_select;
        }else{
            $permissions_select=9;
        }
       return $permissions_select;
    }
}
