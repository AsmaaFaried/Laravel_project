<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostController extends Controller
{


    public function index(){
        $posts=Post::paginate(7);
        return view('posts.index',['posts'=>$posts]);
    }
    public function create(){
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }
    public function store(Request $request){
        Post::create([
            'title' => $request->input('title'),
            'description'=>$request->input('description'),
            'post_creator'=>$request->input('post_creator'),
        ]);
        return to_route('post.index');
    }

    public function show($postId){
        $data=Post::find($postId);
        $users=User::all();
        $comments=$data->comments->all();
        return view('posts.details',['data'=>$data,'comments'=>$comments,'users'=>$users]);
    }

    public function editPost($postId){
        $data=Post::find($postId);
        return view('posts.update',['postId'=>$postId,'data'=>$data]);
    }
    public function destroy($postId){
        $result=Post::find($postId)->delete();
        if($result){
            return redirect()->back()->with(['success'=>"Post Deleted successfully."]);

        }else{
            return redirect()->back()->with(['error'=>"Failed to delete this post"]);
        }
    }
    public function update(Request $request,$postId){
        $post = Post::find($postId);
        $post->title =$request->input('title');
        $post->description = $request->input('description');
        $post->post_creator = $request->input('post_creator');
        $result=$post->update();
        if($result){
            return redirect()->back()->with(['success'=>'Post Updated Successfully']);

        }
        else{
            return redirect()->back()->with(['error'=>'Failed to update this post']);
        }
    }

}
