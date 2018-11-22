<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Models\User;
class CheckUniqueController extends Controller
{
       public function checkPermissionName(Request $request)
        {
            // Simple search
            //$request=array_map('trim', $request->all());
            $request=$request->all();
            $permission_name=trim($request['name']);
            //$isPass=trim($request['isPass']);
            //if($isPass===1){
            //    return response()->json([
            //        'status' => '1',
            //    ]);
            //}
            $permissions = Permission::where("name",$permission_name)->count();
            if($permissions>0){
                return response()->json([
                    'status' => '0',
                ]);
            }else{
                return response()->json([
                    'status' => '1',
                ]);
            }
        }
    public function checkUserEmail(Request $request)
    {
        $request=$request->all();
        $email=trim($request['email']);

        $users = User::where("email",$email)->count();
        if($users>0){
            return response()->json([
                'status' => '0',
            ]);
        }else{
            return response()->json([
                'status' => '1',
            ]);
        }
    }

    public function checkUserName(Request $request)
    {
        $request=$request->all();
        $name=trim($request['name']);

        $users = User::where("name",$name)->count();
        if($users>0){
            return response()->json([
                'status' => '0',
            ]);
        }else{
            return response()->json([
                'status' => '1',
            ]);
        }
    }


    public function checkRole(Request $request)
    {
        $request=$request->all();
        $name=trim($request['name']);

        $roles = User::where("email",$name)->count();
        if($roles>0){
            return response()->json([
                'status' => '0',
            ]);
        }else{
            return response()->json([
                'status' => '1',
            ]);
        }
    }
}
