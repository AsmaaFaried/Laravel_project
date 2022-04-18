<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Post;
class CommentController extends Controller
{
    public function addComment(Request $request,$postId){
        $post=Post::find($postId);
        $comment=$post->comments()->create([
            'comment'=>$request->input('comment'),
            'user_id'=>$request->input('comment_creator')
        ]);
        if($comment){
            return redirect()->back()->with(['success'=>'Comment added successfully']);
        }else{
            return redirect()->back()->with(['error'=>'Comment failed to post']);
        }
    }

    public function destroyComment($postId,$commentId){
        $post=Post::find($postId);
        $comment=$post->comments->find($commentId);
        $result=$comment->delete();
        if($result){
            return redirect()->back()->with(['success'=>"comment is deleted successfully"]);

        }else{
            return redirect()->back()->with(['error'=>"Failed to delete this comment"]);

        }
    }
}
