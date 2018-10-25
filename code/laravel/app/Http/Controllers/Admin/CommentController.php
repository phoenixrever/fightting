<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\Blog;
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
                'floor'=>1,
                'body'=>$request['content'],
            ]);
            $user = Auth::user();
            $comment->blog()->associate($blog);
            $comment->user()->associate($user);
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
        $replyTo=$input['replyTo']?$input['replyTo']:null;
        if($this->canWrite && $blog->comment_level<100 ) {
            $reply_comment = ReplyComment::create([
                'reply_to'=>$replyTo,
                'body' => $input['data'],
            ]);
            $user = Auth::user();
            $comment = Comment::findOrFail($id);
            $reply_comment->comment()->associate($comment);
            $reply_comment->user()->associate($user);
            $reply_comment->save();

            $strArr=explode(":",$reply_comment->body);
            $str=$strArr[0];
            unset($strArr[0]);
            $body_text=implode("",$strArr);

            return response()->json([
                'status' => '1',
                'head'=>$str,
                'body'=>$body_text,
                'created_at'=>$reply_comment->created_at,
                'id'=>$reply_comment->user->id,
                'name'=>$reply_comment->user->name,
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
