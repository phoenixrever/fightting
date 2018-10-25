<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Datatables;

class RoleController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'isAdmin']); // isAdmin 中间件让具备指定权限的用户才能访问该资源
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anyData()
    {
        $roles = Role::select(['id', 'name', 'created_at', 'updated_at']);

        return Datatables::of($roles)
            ->addIndexColumn()
            ->addColumn('permissions', function ($roles) {
                $permission_names = $roles->permissions()->pluck('name');
                $select_str = '';
                foreach ($permission_names as $name) {
                    $select_str .= '<span  class="selected-permissions label label-inverse m-r-5" value="'.$name.'">'.$name.'</span>';
                }

                //$select_str.='<span class="label label-inverse m-r-5" value="xxx">xxasd121</span>';
                return $select_str;
            })
            ->addColumn('action', function ($roles) {
                return '<a href="###" id="delete-'.$roles->id.'" class="btn btn-xs btn-danger delete"><i class="fas fa-trash-alt"></i> Delete</a>';
            })
            ->rawColumns(['action', 'permissions'])//->setRowId('id')
            //->editColumn('description', '<div>{{$id}}</div>')
            //->removeColumn('description')
            ->make(true);
    }

    public function index()
    {
        //$roles = Role::all();// 获取所有角色
        ////dd(Permission::where('name','111')->get()->count());
        //$orign_rules=[
        //    'name'=>'required|max:20|unique:permissions',
        //    'description'=>'required|max:100',
        //];
        //$rules=null;
        //$data=[
        //    'name'=>'111111',
        //];
        //
        //foreach ($data as $key=>$value){
        //    if(array_key_exists($key,$orign_rules)){
        //        $rules[$key]=$orign_rules[$key];
        //    }
        //}
        // dd($rules);

        return view('admin.roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();// 获取所有权限

        return view('roles.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $data = json_decode($input['data'], true);
        array_walk_recursive($data, function (&$item, $key) {

            if (is_string($item) && ! str_contains($key, 'password')) {
                $item = trim($item);
                if($item==='name'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });

        $origin_rules = [
            'name' => 'required|max:20|unique:roles',
            'permissions' => 'required',
        ];

        $rule_permissions = [
            'permissions' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Permission::where('name', $value)->get()->count() < 1) {
                        return $fail($attribute.' is not exist.');
                    }
                },
            ],
        ];
        $role = new Role();
        $id_index = 0;
        $validator = \Validator::make($data, $origin_rules);
        if ($validator->passes()) {
            $errors = '';
            $pass = 1;
            $temp = [];
            for ($i = 0; $i < count($data['permissions']); $i++) {
                $temp['permissions'] = $data['permissions'][$i];
                $validator_permission[$i] = \Validator::make($temp, $rule_permissions);
                if (! $validator_permission[$i]->passes()) {
                    $pass = 0;
                    $errors = $validator_permission[$i]->errors()->all();
                    break;
                }
            }

            if ($pass === 1) {
                foreach ($data as $key => $value) {
                    if (array_key_exists($key, $origin_rules)) {
                        if ($key !== 'permissions') {
                            $role->$key = $value;
                            $role->save();
                        }
                    }
                }
                foreach ($data['permissions'] as $k => $v) {
                    $p = Permission::where('name', '=', $v)->firstOrFail();
                    $role->givePermissionTo($p);
                }

                $rolesAllData = Role::orderby($data['current_sort'], $data['sort_direction'])->get();
                foreach ($rolesAllData as $r) {
                    if ($r->name == $data['name']) {
                        $id = $r->id;
                        break;
                    }
                    $id_index++;
                }

                return response()->json([
                    'status' => '1',
                    'id' => $id,
                    'id_index' => $id_index,
                    'rules' => $role,
                ]);
            } else {
                return response()->json([
                    'errors' => $errors,
                    //'errors' =>"Already exists",
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //$data = [
        //    'permissions' => [],
        //];
        //$id = 2;
        $role = Role::findOrFail($id); // 通过给定id获取角色
        $input = $request->all();
        $data = json_decode($input['data'], true);
        array_walk_recursive($data, function (&$item, $key) {

            if (is_string($item) && ! str_contains($key, 'password')) {
                $item = trim($item);
                if($item==='name'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });

        $origin_rules = [
            'name' => 'required|max:20|unique:roles',
            'permissions' => 'required',
        ];

        $rule_permissions = [
            'permissions' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (Permission::where('name', $value)->get()->count() < 1) {
                        return $fail($attribute.' is not exist.');
                    }
                },
            ],
        ];

        $rules = null;
        $id_index = 0;

        foreach ($data as $key => $value) {
            if (array_key_exists($key, $origin_rules)) {
                $rules[$key] = $origin_rules[$key];
            }
        }

        $validator = \Validator::make($data, $rules);
        if ($validator->passes()) {
            if (array_key_exists('permissions', $data)) {
                $errors = '';
                $pass = 1;
                $temp = [];
                for ($i = 0; $i < count($data['permissions']); $i++) {
                    $temp['permissions'] = $data['permissions'][$i];
                    $validator_permissions[$i] = \Validator::make($temp, $rule_permissions);
                    if (! $validator_permissions[$i]->passes()) {
                        $pass = 0;
                        $errors = $validator_permissions[$i]->errors()->all();
                        break;
                    }
                }

                if ($pass === 1) {
                    $p_all = Permission::all();//获取所有权限
                    foreach ($p_all as $p) {
                        $role->revokePermissionTo($p); // 移除与角色关联的所有权限
                    }
                    foreach ($data['permissions'] as $k => $v) {
                        $p = Permission::where('name', '=', $v)->firstOrFail();
                        $role->givePermissionTo($p);
                    }
                    $role->updated_at=Now();
                    $role->save();
                } else {
                    return response()->json([
                        'errors' => $errors,
                        //'errors' =>"Already exists",
                    ]);
                }
            }
            foreach ($data as $key => $value) {
                if ($key !== 'permissions') {
                    if (isset($role->$key)) {
                        $role->$key = $value;
                        $role->save();
                    }
                }
            }
            $rolesAllData = Role::orderby($data['current_sort'], $data['sort_direction'])->get();
            foreach ($rolesAllData as $r) {
                if ($r->id == $id) {
                    break;
                }
                $id_index++;
            }

            return response()->json([
                'status' => '1',
                'id_index' => $id_index,
                'id' => $id,
            ]);
        } else {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::findOrFail($id);
        $role->delete();

        //return redirect()->route('roles.index')->with('flash_message', 'Role deleted!');
        return response()->json([
            'success' => '1',
        ]);
    }

    public function multiDelete(Request $request)
    {
        //
        $back_data = [];
        //$ids=explode("-",$request->input('deleteStr'));
        $input = $request->all();
        $ids = json_decode($input['data'], true);

        foreach ($ids as $id) {
            $role = Role::findOrFail($id);

            array_push($back_data, '权限 '.$role->name.' 删除成功');
            $role->delete();
        }
        //$back_data=implode($back_data,"<br>");
        //return redirect()->route('permissions.index')
        //    ->with('flash_message',$back_data);
        return response()->json([
            'success' => '1',
            'back_data' => $back_data,
        ]);
    }
}
