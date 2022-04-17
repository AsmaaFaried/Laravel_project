<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostController extends Controller
{
   
   
    public function index(){
        $posts=Post::paginate(5);
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
        return view('posts.details',['data'=>$data]);
    }
 
    public function editPost($postId){
        $data=Post::find($postId);
        return view('posts.update',['postId'=>$postId,'data'=>$data]);
    }
    public function destroy($postId){
        Post::find($postId)->delete();
        return redirect()->back()->with(['success'=>"Post Deleted successfully."]);
    }
    public function update(Request $request,$postId){
        $post = Post::find($postId);
        $post->title =$request->input('title');
        $post->description = $request->input('description');
        $post->post_creator = $request->input('post_creator');
        $post->update();
        return redirect()->back()->with(['success'=>'Student Updated Successfully']);
    }
    
}
