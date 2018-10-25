<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Select2Controller extends Controller
{
    protected $table = 'role';

    public function select2(Request $request, $name)
    {
        $request = $request->all();
        $eloquent = null;
        $results =null;
        switch ($name) {
            case 'roles':
                if (isset($request['q'])) {
                    $q = trim($request['q']);
                    $results = Role::search($q)->get();
                } else {
                    $results =  Role::select(['name'])->orderBy("name")->get();
                }
                break;
            case 'permissions':
                if (isset($request['q'])) {
                    $q = trim($request['q']);
                    $results = permission::search($q)->get();
                } else {
                    $results =  permission::select(['name'])->orderBy("name")->get();
                }
        }


        $arr = [];

        for ($i = 0; $i < count($results); $i++) {
            $arr['results'][$i]['id'] = $results[$i]->name;
            $arr['results'][$i]['text'] = $results[$i]->name;
        }
        $arr["pagination"]['more'] = true;
        $arr = json_encode($arr);

        return $arr;
    }
}
