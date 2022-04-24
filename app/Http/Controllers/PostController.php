<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('PostImage')) {
            $image=$request->file('PostImage');
            $name = $image->getClientOriginalName();
            $request->file('PostImage')->storeAs('public/PostImages/',$name);
            $userName=$request->input('post_creator');
            $postCreator=Post::where('post_creator',$userName)->first();
            // $userId=$postCreator->user->id;
            // if($userId !=NULL){
                $result=Post::create([
                    'title' => $request->input('title'),
                    'PostImage'=>$name,
                    'slug'=>Str::slug($request->input('title'), '-'),
                    'description'=>$request->input('description'),
                    'post_creator'=>$request->input('post_creator'),
                ]);
                if ($result) {
                    return to_route('post.index');
                } else {
                    return redirect()->back()->with(['error'=>'Post failed to create']);
                }
            // }else{
            //     return redirect()->back()->with(['error'=>"Post creator doesn't exist"]);

            // }

        }
    }

    public function show($slug){
        $data=Post::where('slug',$slug)->first();

        $users=User::all();
        $comments=$data->comments->all();

        return view('posts.details',['data'=>$data,'comments'=>$comments,'users'=>$users]);
    }

    public function editPost(Request $request,$slug){

        $data=Post::where('slug',$slug)->first();

        return view('posts.update',['slug'=>$slug,'data'=>$data]);
    }
    public function destroy($postId){
        $post=Post::find($postId);
        Storage::disk('public')->delete('PostImages/'.$post['PostImage']);
        $result=$post->delete();
        if($result){
            return redirect()->back()->with(['success'=>"Post Deleted successfully."]);

        }else{
            return redirect()->back()->with(['error'=>"Failed to delete this post"]);
        }
    }
    public function update(Request $request, Post $post,$slug){
        $postData = Post::where('slug',$slug)->first();
        $title=$request->input('title');

        if ($request->hasFile('PostImage')) {
            Storage::disk('public')->delete('PostImages/'.$postData['PostImage']);
            $image=$request->file('PostImage');
            $name = $image->getClientOriginalName();
            $request->file('PostImage')->storeAs('public/PostImages/', $name);
            $result=$postData->update([
            'title' =>$title,
            'PostImage'=>$name,
            'slug'=> Str::slug($title, '-'),
            'description' => $request->input('description'),
            "post_creator" => $request->input('post_creator'),
         ]);

            if ($result) {
                return redirect()->back()->with(['success'=>'Post Updated Successfully']);
            } else {
                return redirect()->back()->with(['error'=>'Failed to update this post']);
            }
        }else{
            $postData->update($request->input());
            return redirect()->back()->with(['success'=>'Post Updated Successfully']);

        }
    }


    public  function deleteOldPosts(){
        PruneOldPostsJob::dispatch();
        return redirect()->back()->with(['success'=>'Posts deleted successfully']);
    }
}
