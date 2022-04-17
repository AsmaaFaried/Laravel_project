


@extends('layouts.app')
@section('title') Create @endsection

@section('content')
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
    <div class="card">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <label class="card-title" style="font-weight: bold">Name:</label>
            <span class="card-text">{{ $data->post_creator }}</span>
            <br>
            <label class="card-title" style="font-weight: bold">Email:</label>
            <span class="card-text">{{ $data->user->email}}</span><br>
            <label class="card-title" style="font-weight: bold">Created At:</label>
            <span class="card-text">{{ $data->created_at }}</span><br>
            <a href="{{ route('post.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
    
@endsection


