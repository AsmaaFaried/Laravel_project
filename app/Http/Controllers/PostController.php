<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
   
   
    public function index(){
        $posts=Post::all();
        return view('posts.index',['posts'=>$posts]);
    }
    public function create(){
        $posts=Post::all();
        return view('posts.create',['posts'=>$posts]);
    }
    public function store(Request $request){
        $posts=Post::insert([
            'title' => $request->input('title'),
            'description'=>$request->input('descrip'),
            'post_creator'=>$request->input('post_creator'),
            'created_at'=>date("Y-m-d h:i:s"),
        ]); 

        return redirect()->route('post.index');
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
        $post=Post::find($postId)->delete();
       return redirect()->back()->with(['success'=>"Post Deleted successfully."]);
    }
    public function update(Request $request,$postId){
        $post = Post::find($postId);
        $post->title =$request->input('title');
        $post->description = $request->input('descrip');
        $post->post_creator = $request->input('post_creator');
        $post->created_at = date("Y-m-d h:i:s");
        $post->update();
        return redirect()->back()->with(['success'=>'Student Updated Successfully']);
    }
    
}
