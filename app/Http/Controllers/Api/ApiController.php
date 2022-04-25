<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class ApiController extends Controller
{
    public function index(){
        $posts=Post::all();
         // put this instead return $posts;
         return PostResource::collection($posts);

    }
    public function show($postId){
        $result=Post::where('id', $postId)->exists();
        if($result){
            $post=Post::find($postId);

            // put this instead return [];
            return new PostResource($post);
        }
        else{
            return response()->json(["message"=>"This post not found"],404);
        }

    }

    public function store(StorePostRequest $request){
        $image=$request->file('PostImage');
        $name = $image->getClientOriginalName();
            $request->file('PostImage')->storeAs('public/PostImages/',$name);
            $userName=$request->input('post_creator');
            $postCreator=Post::where('post_creator',$userName)->first();
            // $userId=$postCreator->user->id;
                $result=Post::create([
                    'title' => $request->input('title'),
                    'user_id'=>1,
                    'PostImage'=>$name,
                    'slug'=>Str::slug($request->input('title'), '-'),
                    'description'=>$request->input('description'),
                    'post_creator'=>$request->input('post_creator'),
                ]);

                if($result){
                    // put this instead return $posts;
                    return PostResource::collection($result);

                }else{
                    return response()->json(["message"=>"Post failed to create"],404);

                }

    }

}
