<?php

namespace App\Http\Controllers\Admin;

use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Http\Request;

use  App\Http\Controllers\Controller;
use function MongoDB\BSON\toJSON;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use App\Http\Models\User;
use Yajra\Datatables\Datatables;

class PermissionController extends Controller
{
    public function __construct() {
        //$this->middleware(['auth', 'isAdmin','revalidate']); // isAdmin 中间件让具备指定权限的用户才能访问该资源
        //$this->middleware('revalidate')->except("index");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function anyData()
    {
        //return Datatables::of(Permission::query())->make(true);
        $permissions= Permission::select(['id','name', 'description', 'created_at', 'updated_at']);

        return Datatables::of($permissions)
            ->addIndexColumn()
            ->addColumn('action', function ($permissions) {
                return '<a href="###" id="delete-'.$permissions->id.'" class="btn btn-xs btn-danger delete"><i class="fas fa-trash-alt"></i> Delete</a>';
            })
            //->setRowId('id')
            //->editColumn('description', '<div>{{$id}}</div>')
            //->removeColumn('description')
            ->make(true);
    }

    public function index()
    {
        //$permissions = Permission::orderby('updated_at','desc')->paginate(parent::permissions_select()); // 获取所有权限
        //$result=array(null,null,null,parent::permissions_select());
        return view('admin.permissions');
    }

    public function sortIndex($sort_keyword,$sort)
    {
        $a=array("permissions","description");
        $b=array("asc","desc");
        if(!in_array($sort_keyword,$a) || !in_array($sort,$b)){
            return redirect()->route("permissions.index");
        }
        $sortkey=$sort_keyword;
        if($sort_keyword=='permissions'){
            $sortkey="name";
        }
        $permissions = Permission::orderby($sortkey,$sort)->paginate(parent::permissions_select()); // 获取所有权限
        $result=array($sort_keyword,$sort,null,parent::permissions_select());
        return view('admin.permissions.permissions_index',compact('result','permissions'));
    }

    //public function search($search_word)
    //{
    //    // Simple search
    //    $permissions = Permission::search($search_word)->orderby('description','asc')->paginate(parent::permissions_select());;
    //    //dd($permissions);
    //    $result=array(null,null,$search_word,parent::permissions_select());
    //    return view('admin.permissions.permissions_index',compact('result','permissions'));
    //}


    public function sortSearch($sort_keyword,$sort,$search_word)
    {
        // Simple search
        $a=array("permissions","description");
        $b=array("asc","desc");
        if(!in_array($sort_keyword,$a) || !in_array($sort,$b)){
            return redirect()->route("permissions.index");
        }

        $sortkey=$sort_keyword;
        if($sort_keyword=='permissions'){
            $sortkey="name";
        }
        //dd($sort_keyword,$sort,$search_word);
        $permissions = Permission::search($search_word)->orderby($sortkey,$sort)->paginate(parent::permissions_select());
        //dd($permissions);
        $result=array($sort_keyword,$sort,$search_word,parent::permissions_select());
        return view('admin.permissions.permissions_index',compact('result','permissions'));
    }

    //public function search(Request $request, $sort_keyword=null,$sort=null)
    //{
    //    // Simple search
    //    $search_word = $request->get('search_word');
    //    if($sort_keyword==null || $sort==null){
    //      $sort_keyword='updated_at';
    //      $sort='desc';
    //    }
    //    $permissions = Permission::search($search_word)->orderby($sort_keyword,$sort)->paginate(9);
    //    //dd($permissions);
    //    //dd($search_word);
    //    $result=array($sort_keyword,$sort,$search_word);
    //    return view('admin.permissions.permissions_index',compact('result','permissions'));
    //}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$roles = Role::get(); // 获取所有角色
        //$permissions=Permission::paginate("10");
        //return view('admin.permissions.permissons_create',compact('roles','permissions'));
        return redirect()->route("permissions.index");

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
                if($item==='name'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });
        $rules=[
            'name'=>'required|max:20|unique:permissions',
            'description'=>'required|max:200',
        ];
        $validator=\Validator::make($data,$rules);
        if($validator->passes()){
            $permission = new Permission();
            foreach ($data as $key=>$value){
                $permission->guard_name = "web";
                if(array_key_exists($key,$rules)){
                    $permission->$key = $value;
                    $permission->save();
                }
            }

            //$roles = $data['roles'];

            $permission->save();
            $id_index=0;
            $id=0;
            $permissionAllData = Permission::orderby($data['current_sort'],$data['sort_direction'])->get();
            foreach ($permissionAllData as $p){
                if($p->name==$data['name']){
                    $id=$p->id;
                    break;
                }
                $id_index++;
            }

            //if (!empty($data['roles'])) { // 如果选择了角色
            //    foreach ($roles as $role) {
            //        $r = Role::where('id', '=', $role)->firstOrFail(); // 将输入角色和数据库记录进行匹配
            //
            //        $permission = Permission::where('name', '=', $name)->first(); // 将输入权限与数据库记录进行匹配
            //        $r->givePermissionTo($permission);
            //    }
            //}
            //return redirect()->route("permissions.index")->with('flash_message',"权限 ". $permission->name." 增加成功");
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
        return redirect('permissions');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);

        return view('permissions.edit', compact('permission'));

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
        //
        $permission = Permission::findOrFail($id);
        $input = $request->all();
        $data=json_decode($input['data'], true);
        array_walk_recursive($data, function (&$item, $key) {

            if (is_string($item) && !str_contains($key, 'password')) {
                $item = trim($item);
                if($item==='name'){
                    $item=str_replace(' ', '', $item);
                }
            }
        });

        $origin_rules=[
            'name'=>'required|max:20|unique:permissions',
            'description'=>'required|max:100',
        ];

        $rules=null;

        foreach ($data as $key=>$value){
            if(array_key_exists($key,$origin_rules)){
                $rules[$key]=$origin_rules[$key];
            }
        }

        $validator=\Validator::make($data,$rules);

        $id_index=0;
        if($validator->passes()){
            foreach ($data as $key=>$value) {
                if(isset($permission->$key)){
                    $permission->$key=$value;
                    $permission->save();
                }
            }
            $permissionAllData = Permission::orderby($data['current_sort'],$data['sort_direction'])->get();
            foreach ($permissionAllData as $p){
                if($p->id==$id){
                    break;
                }
                $id_index++;
            }
            return response()->json([
                'status' => '1',
                'id_index'=> $id_index,
                'id'=>$id,
                'rules'=>$rules,
            ]);
        }else{
            return response()->json([
                'errors' => $validator->errors()->all(),
                //'errors' =>"Already exists",
            ]);
        }
        //session()->put("flash_message","good");
        //session()->save();
        //return redirect()->route('permissions.index')
        //    ->with('flash_message',
        //        'Permission'. $permission->name.' updated!');
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
        $permission = Permission::findOrFail($id);

        // 让特定权限无法删除
        if ($permission->name == "Administer roles & permissions") {
            return redirect()->route('permissions.index')
                ->with('flash_message',
                    'Cannot delete this Permission!');
        }

        $permission->delete();

        //return redirect()->route('permissions.index')
        //    ->with('flash_message',
        //        '权限 '.$permission->name.' 删除成功');
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
            $permission = Permission::findOrFail($id);
            if ($permission->name == "Administer roles & permissions") {
                return redirect()->route('permissions.index')
                    ->with('flash_message',
                        'Cannot delete this Permission!');
            }
            array_push($back_data,'权限 '.$permission->name.' 删除成功');
            $permission->delete();
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
