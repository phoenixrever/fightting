<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
use App\Http\Models\User;
use App\Http\Models\Comment;
use App\Http\Models\ReplyComment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    private $canWrite = false;

    private $canDelete = false;


    public function checkCommentAccess($comment=""){
        if(Auth()->user()->hasPermissionTo("administrator")){
            $this->canWrite=true;
            $this->canDelete=true;
        }
        if(Auth()->user()->hasPermissionTo("write-comment")){
            $this->canWrite=true;
        }
        if($comment!=="" && Auth()->user()->id===$comment->user->id){
            if(Auth()->user()->hasPermissionTo("delete-comment")){
                $this->canDelete=true;
            }
        }
    }


    public function store(Request $request, $id)
    {
        //
        $this->validate($request, [
            'content' => 'required',
        ]);
        $this->checkCommentAccess();
        $blog = Blog::findOrFail($id);
        if($this->canWrite && $blog->comment_level<100 ) {
            $comment = Comment::create([
                'isShow'=>1,
                'body'=>$request['content'],
            ]);
            $user = Auth::user();
            $comment->blog()->associate($blog);
            $comment->user()->associate($user);
            $floor=Comment::where('blog_id',$id)->orderBy("created_at")->count();
            $comment->floor=$floor+2;
            $comment->save();

            return redirect()->route('blogs.show', $id);
        }
    }

    public function ajaxReplyStore(Request $request, $id)
    {
        //
        $this->validate($request, [
            'data' => 'required',
            'blogId'=>'required'
        ]);
        $input = $request->all();
        $this->checkCommentAccess();
        $blog = Blog::findOrFail($input['blogId']);

        $body =strip_tags($input['data'],'<img>');//strip_tags(string,allow)  allow	可选。规定允许的标签。这些标签不会被删除。

        preg_match_all('/<img[^>]+>/i', $body, $result);
        $img = array();
        for($i=0;$i<count($result[0]);$i++)
        {
            preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $result[0][$i], $matches);
            $img[$i]=$matches[1];
        }
        $confirm=1;
        foreach ($img as $i){
            $c=strstr($i,"http://192.168.2.100/assets/plugins/jquery-emoji/dist/img");
            if($c===false){
                $confirm=0;
                break;
            }
        }
        if($confirm!==1){
            return response()->json([
                'status' => '0',
                //'body'=>  $body,
                //'created_at'=>$reply_comment->created_at,
                //'id'=>$reply_comment->user->id,
                //'name'=>$reply_comment->user->name,
            ]);
        }

        $replyTo=$input['replyTo']?$input['replyTo']:null;
        $replyToName=$input['replyToName']?$input['replyToName']:null;
        if($replyTo===null || $replyToName===null){
            $replyTo=null;
            $replyToName=null;
        }
        if($this->canWrite && $blog->comment_level<100 ) {
            $reply_comment = ReplyComment::create([
                'reply_to'=>$replyTo,
                'reply_to_name'=>$replyToName,
                'body' => $body,
            ]);
            $user = Auth::user();
            $comment = Comment::findOrFail($id);
            $reply_comment->comment()->associate($comment);
            $reply_comment->user()->associate($user);
            $reply_comment->save();

            //if($replyTo===null){
            //    $body_text=$body;
            //}else{
            //    $strArr=explode("<->",$reply_comment->body);
            //    $str=$strArr[0];
            //    unset($strArr[0]);
            //    $body_text=implode("",$strArr);
            //}

            //$replyToName=User::find($replyTo)->name;
            $replys=$comment->replyComments()->with("user")->get();
            return response()->json([
                'status' => '1',
                'replys'=>$replys,
                'body'=>$img
                //'body'=>  $body,
                //'created_at'=>$reply_comment->created_at,
                //'id'=>$reply_comment->user->id,
                //'name'=>$reply_comment->user->name,
            ]);
        }
    }

    public function delete($id)
    {
        //
        $comment = Comment::findOrFail($id);
        $this->checkCommentAccess($comment);
        if ($this->canDelete) {
            $comment->delete();
            $blog_id=$comment->blog->id;
            return redirect()->route('blogs.show',$blog_id);
        }
    }

    public function ajaxReplyDelete($id)
    {
        //
        $reply_comment = ReplyComment::findOrFail($id);
        $this->checkCommentAccess($blog);
        if ($this->canDelete) {
            $blog->delete();

            return redirect()->route('blogs.index');
        }
    }
}
