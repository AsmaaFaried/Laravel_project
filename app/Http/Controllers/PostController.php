<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class PostController extends Controller
{


    public function index(){
        $posts=Post::paginate(7);
        // dd($posts);
        return view('posts.index',['posts'=>$posts]);
    }
    public function create(){
        $users=User::all();
        return view('posts.create',['users'=>$users]);
    }
    public function store(StorePostRequest $request)
    {
        $result=Post::create([
            'title' => $request->input('title'),
            'slug'=>Str::slug($request->input('title'),'-'),
            'description'=>$request->input('description'),
            'post_creator'=>$request->input('post_creator'),
        ]);

        if($result){

            return to_route('post.index');
        }else{

            return redirect()->back()->with(['error'=>'Post failed to create']);
        }
    }

    public function show($slug){
        $data=Post::where('slug',$slug)->first();

        $users=User::all();
        $comments=$data->comments->all();

        return view('posts.details',['data'=>$data,'comments'=>$comments,'users'=>$users]);
    }

    public function editPost($slug){
        $data=Post::where('slug',$slug)->first();
        return view('posts.update',['slug'=>$slug,'data'=>$data]);
    }
    public function destroy($postId){
        $result=Post::find($postId)->delete();
        if($result){
            return redirect()->back()->with(['success'=>"Post Deleted successfully."]);

        }else{
            return redirect()->back()->with(['error'=>"Failed to delete this post"]);
        }
    }
    public function update(Request $request, Post $postdata,$slug){
        $post = Post::where('slug',$slug)->first();
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
    public  function deleteOldPosts(){
        PruneOldPostsJob::dispatch();
        return redirect()->back()->with(['success'=>'Posts deleted successfully']);
    }
}
