<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
// 引入 laravel-permission 模型
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// 用于输出一次性信息

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    //public function __construct()
    //{
    //    $this->middleware(['auth','isAdmin']);
    //}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function anyData()
    {
        //return Datatables::of(Permission::query())->make(true);
        $users= User::select(['id','name', 'email', 'created_at', 'updated_at']);

        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('roles', function ($users) {
                $roles = $users->roles()->pluck('name','id');// name在前 ID 在后
                $select_str = '';
                foreach ($roles as $id=>$name) {
                    $select_str .= '<span  class="selected-permissions label label-inverse m-r-5" value="'.$id.'">'.$name.'</span>';
                }
                //$select_str.='<span class="label label-inverse m-r-5" value="xxx">xxasd121</span>';
                return $select_str;
            })
            ->addColumn('action', function ($users) {
                return '<a href="###" id="delete-'.$users->id.'" class="btn btn-xs btn-danger delete"><i class="fas fa-trash-alt"></i> Delete</a>';
            })
            //->setRowId('id')
            //->editColumn('description', '<div>{{$id}}</div>')
            //->removeColumn('description')
            ->rawColumns(['action', 'roles'])//->setRowId('id')
            ->make(true);
    }

    public function index()
    {
        //$permissions = Permission::orderby('updated_at','desc')->paginate(parent::permissions_select()); // 获取所有权限
        //$result=array(null,null,null,parent::permissions_select());
        return view('admin.users');
    }

    //public function index()
    //{
    //    $users=User::paginate(10);
    //
    //    return view("admin.users.users_table")->with('users',$users);
    //}

    public function search($keyword)
    {
        // Simple search
        $users = User::search($keyword)->get();

        //// Search and get relations
        //// It will not get the relations if you don't do this
        //$users = User::search($keyword)
        //    ->with('Blog')
        //    ->get();
        dd($users);
        return view("admin.users.users_table")->with('users',$users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles=Role::get();

        return view('admin.users.create',$roles);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request=$request->all();
        $data=json_decode($request['data'], true);
        array_walk_recursive($data, function (&$item, $key) {

            if (is_string($item) && !str_contains($key, 'password')) {
                $item = trim($item);
                if($item==='name' | $item==='email'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });
        $rules=[
                'name' =>'required|max:120',
                'email' => 'required|email|unique:users',
                'password'=>[
                    'required',
                    'min:6',
                    'max:20',
                    'confirmed',
                    'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',//regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'
                    /* Should have At least one Uppercase letter.
                        At least one Lower case letter.
                        Also,At least one numeric value.
                        And, At least one special character.
                        Must be more than 6 characters long.
                    */
                ]
        ];
        $validator=\Validator::make($data,$rules);
        if($validator->passes()){
            $user=User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                //'password' => Hash::make($data['password']),
                'password' =>$data['password'],
            ]);
            if(isset($data['roles'])){
                foreach ($data['roles'] as $r){
                    $r = Role::where('name','=',$r)->firstOrfail();
                    $user->assignRole($r);//dd($role_r) 验证
                }
            }
            $id_index=0;
            $id=0;
            $userAllData = User::orderby($data['current_sort'],$data['sort_direction'])->get();
            foreach ($userAllData as $u){
                if($u->email==$data['email']){
                    $id=$u->id;
                    break;
                }
                $id_index++;
            }
            return response()->json([
                'status' => '1',
                'id_index'=>$id_index,
                'id'=>$id,
            ]);
        }else{
            return response()->json([
                "errors"=>$validator->messages()->all(),
                //'jumpPage'=>,
            ]);
        }

        //
        //$this->validate($request,[
        //    'name' =>'required|max:120',
        //    'email' => 'required|email|unique:users',
        //    'password'=>'required|min:6|confirmed'
        //]);
        ////dd($user); 验证
        //$user = User::create($request->only('emai','name','password'));
        //$roles=$request['roles'];
        //
        //if(isset($roles)){
        //    foreach ($roles as $role){
        //        $role_r = Role::where('id','=','$role')->firstOrfail();
        //        $user->assginRole($role_r);//dd($role_r) 验证
        //    }
        //}
        //
        //return redirect()->route('users.index')
        //    ->with('flash_message',
        //        'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查看user 属性 是对象吗
        $user = User::findOrFail($id);
        $roles=Role::get();

        return view('user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $data=json_decode($input['data'], true);
        array_walk_recursive($data, function (&$item, $key) {

            if (is_string($item) && !str_contains($key, 'password')) {
                $item = trim($item);
                if($item==='name' | $item==='email'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });

        $origin_rules=[
            'email'=>'required|email|unique:users',
            'name'=>'required|max:200|unique:users',
            'roles'=>'max:200',
        ];

        $user_roles = [
            'roles' => [
                //'required',
                function ($attribute, $value, $fail) {
                    if (Role::where('name', $value)->get()->count() < 1) {
                        return $fail($attribute.' is not exist.');
                    }
                },
            ],
        ];

        $rules=null;

        foreach ($data as $key=>$value){
            if(array_key_exists($key,$origin_rules)){
                $rules[$key]=$origin_rules[$key];
            }
        }

        $validator=\Validator::make($data,$rules);

        $id_index=0;
        $roles=null;
        if($validator->passes()){
            if (array_key_exists('roles', $data)) {
                if(count($data['roles'])!==0){
                    $errors = '';
                    $pass = 1;
                    $temp = [];
                    for ($i = 0; $i < count($data['roles']); $i++) {
                        $temp['roles'] = $data['roles'][$i];
                        $validator_roles[$i] = \Validator::make($temp, $user_roles);
                        if (! $validator_roles[$i]->passes()) {
                            $pass = 0;
                            $errors = $validator_roles[$i]->errors()->all();
                            break;
                        }
                    }

                    if ($pass === 1) {
                        //$roles=Role::with('permissions')->get();//找出roles 并且每一条roles包含起has的permissions
                        //foreach ($data['roles'] as $r) {
                        //    $role=Role::where('name',$r)->first();//get 与first
                        //    $user->roles()->sync($role->id);
                        //}
                        $roles_ids=Role::whereIn('name',$data['roles'])->pluck('id');//get 与first    get必须要数组参数
                        //$roles_ids=Role::whereIn('name',$data['roles'])->get(['id']);//get 与first
                        $user->roles()->sync($roles_ids);
                    } else {
                        return response()->json([
                            'errors' => $errors,
                            //'errors' =>"Already exists",
                        ]);
                    }
                }else{
                    $user->roles()->detach();
                }
            }
            foreach ($data as $key=>$value) {
                if($key!=='roles' && $key!=='password'){
                    if(isset($user->$key)){
                        $user->$key=$value;
                        $user->save();
                    }
                }
            }
            $userAllData = User::orderby($data['current_sort'],$data['sort_direction'])->get();
            foreach ($userAllData as $u){
                if($u->id==$id){
                    break;
                }
                $id_index++;
            }

            return response()->json([
                'status' => '1',
                'id_index'=>$id_index,
                'id'=>$id,
            ]);
        }else{
            return response()->json([
                'errors' => $validator->errors()->all(),
                //'errors' =>"Already exists",
            ]);
        }

        //$user = User::findOrFail($id);
        //$this->validate($request,[
        //    'name'=>'required|max:120',
        //    'email'=>'required|email|unique:users,email,'.$id,// 不懂 待会看下
        //    'password'=>'required|min:6|confirmed'
        //]);
        //
        //$input = $request->only(['name', 'email', 'password']); // 获取 name, email 和 password 字段
        //$user->fill($input)->save();

        //return redirect()->route('users.index')
        //    ->with('flash_message',
        //        'User successfully edited.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success'=>'1',
        ]);
    }

    public function multiDelete(Request $request)
    {
        //
        $back_data=array();
        //$ids=explode("-",$request->input('deleteStr'));
        $input = $request->all();
        $ids=json_decode($input['data'], true);

        foreach ($ids as $id){
            $user = User::findOrFail($id);
            if ($user->name == "Administer roles & permissions") {
                return redirect()->route('permissions.index')
                    ->with('flash_message',
                        'Cannot delete this Permission!');
            }
            array_push($back_data,'权限 '.$user->name.' 删除成功');
            $user->delete();
        }
        //$back_data=implode($back_data,"<br>");
        //return redirect()->route('permissions.index')
        //    ->with('flash_message',$back_data);
        return response()->json([
            'success'=>'1',
            'back_data'=>$back_data,
        ]);

    }

}
