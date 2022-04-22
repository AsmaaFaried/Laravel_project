@extends('layouts.app')
@section('title') Details @endsection

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif
<br>

    <div class="card">

        <div class="card-header">
        Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title:</h5>
            <p class="card-text">{{ $data->title }}</p>
            <h5 class="card-title">Description:</h5>
            <p class="card-text">{{ $data->description }}</p>

        </div>
    </div>
    <br>
    <div class="card postCreator">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <label class="card-title" >Name:</label>
            <span class="card-text">{{ $data->post_creator }}</span>
            <br>
            <label class="card-title" >Email:</label>
            <span class="card-text">{{ $data->user->email}}</span><br>
            <label class="card-title" >Created At:</label>
            <span class="card-text">{{ $data->created_at->isoFormat('dddd Do of MMMM YYYY h:mm:ss A') }}</span><br>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            Post Comment
        </div>
        <div class="card-body">
            @include('posts.comment')
        </div>
    </div>

@foreach ($comments as $comment )

<br>

    <div class="card comments" >

        <div class="card-header">
        Comments
        </div>

        <div class="card-body">
            <label class="card-title">User:</label>
            @if($data->id === $comment->user->id)
            <span class="card-text">You</span>

            @else
            <span class="card-text">{{ $comment->user->email }}</span>
            @endif
            <br>
            <label class="card-title">Comment:</label>
            <span class="card-text">{{ $comment->comment }}</span><br>
            <label class="card-title">Created At:</label>
            <span class="card-text">{{ $comment->created_at->addSeconds()->diffForHumans();   }}</span>
            <br>
            <form method="post" action="{{ route('delete.comment',['postId'=>$data->id,'commentId'=>$comment['id']]) }}" style="display: inline-block;">
                @csrf
                @method('delete')
            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        </div>
    </div>
    @endforeach
@endsection


