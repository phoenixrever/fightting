<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use Auth;

class BlogController extends Controller
{
    /**
     * BlogController constructor.
     */
    private $canEdit=false;
    private $canWrite=false;
    private $canDelete=false;


    public function __construct()
    {
        //$this->middleware(['auth','clearance'])->except('index','show');
        $this->middleware(['auth'])->except('index','show');
    }


    public function checkBlogAccess($blog=""){
        if(Auth()->user()->hasPermissionTo("administrator")){
            $this->canEdit=true;
            $this->canWrite=true;
            $this->canDelete=true;
        }
        if(Auth()->user()->hasPermissionTo("write-blog")){
            $this->canWrite=true;
        }
        if($blog!=="" && Auth()->user()->id===$blog->user->id){
            if(Auth()->user()->hasPermissionTo("edit-blog")){
                $this->canEdit=true;
            }
            if(Auth()->user()->hasPermissionTo("delete-blog")){
                $this->canDelete=true;
            }
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$blogs=Blog::where('isTop',0)->except('body')->orderby('updated_at','desc')->paginate(5);
        //
        //$blogs=Blog::select(['id','title','created_at','updated_at'])->where('isTop',0)->orderby('updated_at','desc')
        //    ->with(['comments'=>function($query){
        //                $query->where('isShow',1)->orderBy('updated_at','desc')->firstOrFail()->name;
        //    }])->paginate(5);

        //$blogs=Blog::select(['id','title','created_at','updated_at'])->where('isTop',0)->orderby('updated_at','desc')
        //    ->with('user')->with(['comments'=>function($query){
        //        $query->orderBy('updated_at','desc')->first();
        //        if($query){
        //            $query->with('user');
        //        }
        //    }])->paginate(5);
        $blogs=Blog::with('user:id,name,updated_at')->with(['comments'=>function($query){
            $query->with('user:id,name')->select(['id','created_at','user_id','blog_id'])->orderBy("updated_at",'desc')->get();
        }])
            ->select(['id','title','created_at','updated_at','user_id','body'])
            //->addSelect(\DB::raw("'fakeValue' as fakeColumn"))
            ->where('isTop',0)
            ->orderby('updated_at','desc')
            ->paginate(5);
        foreach($blogs as $blog) {
            preg_match_all('/<img[^>]+>/i', $blog->body, $result);
            $blog->body = $result[0];
        }
        $i=rand(1,5);
        $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
        $jumbotron_cover="frontend_assets/img/cover/cover-pain.jpg";
        $a=[
            'boxedLayout'=>1,
            'paceTop'=>1,
            'bodyExtraClass'=>1,
            'sidebarHide'=>1,
            'headerMenu'=>1,
            'headerMegaMenu'=>1,
            //'topMenu'=>1,
            'footer'=>1,
            'page_cover'=>url($cover_path),
            'jumbotron_cover'=>url( $jumbotron_cover),
            'contentInverseMode'>1,
            'blogs'=>$blogs,
            'editor'=>'normalEditor',
        ];

        return view("frontend.category",$a);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.blog.blog_create");
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
       $this->checkBlogAccess();
       if($this->canWrite){
           $rules=[
               'title' => 'required|max:100',
               'content' => 'required',
           ];

           $validator=\Validator::make($request->all(),$rules);

           $title=$request['fullname'];
           $body=$request['content'];
           $blog=Blog::create([
               'isTop'=>0,
               'title'=>$title,
               'body'=>$body,
           ]);
           $user=Auth::user();
           $blog->user()->associate($user);
           $blog->save();

           return redirect()->route('blogs.index')->with('flash_message',$validator->errors()->all());
       }else{
           return redirect()->route('blogs.index')->with('flash_message',"you can not write a blog");
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
        //$blog = Blog::findOrFail($id)->with(['comments'=>function($query){
        //    $query->where('isShow',1);
        //}])->paginate(5);
        $blog = Blog::findOrFail($id);
        $comments =  $blog->comments()->where('isShow',1)->with('user:id,name')->with(["replyComments"=>function($query){
            $query->with("user:id,name");
        }])->orderBy("created_at",'asc')->paginate(5);
        //$comments= Comment::with("replyComments")->get();
        //$blog->comments()->create([
        //    'body' => 'A new comment.',
        //    'isShow'=>1,
        //]);
        //dd($blog->body);
        $i=rand(1,5);
        $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
        $jumbotron_cover="frontend_assets/img/cover/cover-pain.jpg";
        $a=[
            'boxedLayout'=>1,
            'paceTop'=>1,
            'bodyExtraClass'=>1,
            'sidebarHide'=>1,
            'headerMenu'=>1,
            'headerMegaMenu'=>1,
            //'topMenu'=>1,
            'footer'=>1,
            'page_cover'=>url($cover_path),
            'jumbotron_cover'=>url( $jumbotron_cover),
            'contentInverseMode'>1,
            'blog'=>$blog,
            'comments'=>$comments,
            'editor'=>'simpleEditor',
        ];

        return view('frontend.detail',$a);

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
        $blog = Blog::findOrFail($id);
        $this->checkBlogAccess($blog);
        if($this->canEdit){
            $i=rand(1,5);
            $cover_path="frontend_assets/img/cover/star-".$i.".jpg";
            $jumbotron_cover="frontend_assets/img/cover/cover-pain.jpg";
            $a=[
                'boxedLayout'=>1,
                'paceTop'=>1,
                'bodyExtraClass'=>1,
                'sidebarHide'=>1,
                'headerMenu'=>1,
                'headerMegaMenu'=>1,
                //'topMenu'=>1,
                'footer'=>1,
                'page_cover'=>url($cover_path),
                'jumbotron_cover'=>url( $jumbotron_cover),
                'contentInverseMode'>1,
                'editor_blog'=>$blog,
                'editor'=>'updateEditor',
                'shadow'=>'600',
            ];
            return view('frontend.blog-edit',$a);
        }
        abort('401');
    }


    /**
     * ajax Update the specified resource in storage.
     */
    public function ajaxUpdate(Request $request, $id)
    {
        //
        $blog = Blog::findOrFail($id);
        $this->checkBlogAccess($blog);
        if($this->canEdit){
            $this->validate($request,[
                'data' => 'required',
            ]);
            $input = $request->all();

            $blog->body= $input['data'];
            $blog->save();

            return response()->json([
                'status' => '1',
            ]);
        }
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
        $blog = Blog::findOrFail($id);
        $this->checkBlogAccess($blog);
        if($this->canEdit){
            $this->validate($request,[
                'content' => 'required',
            ]);

            //待会用 blog::create 验证一下是不是一样
            $blog->body=$request->input('content');
            $blog->save();

            return redirect()->route("blogs.show",$id);
        }
    }

    public function delete($id)
    {
        //
        $blog = Blog::findOrFail($id);
        $this->checkBlogAccess($blog);
        if($this->canDelete){
            $blog->delete();
            return redirect()->route('blogs.index');
        }
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
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index');
    }
}
