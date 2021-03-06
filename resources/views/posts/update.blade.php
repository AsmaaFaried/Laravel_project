@extends('layouts.app')
@section('title') Update @endsection

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
    <form method="post" action="{{ route('post.update',['slug'=>$slug]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label font-weight-bold">Upload Image</label>
            <input type="file" class="form-control" id="exampleFormControlInput1"  name="PostImage">
            <img style="width:100px;height:100px;" src="{{ asset('storage/PostImages/'.$data->PostImage) }}" alt="postImage" title="postImage">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$data->id }}" name="postId" hidden>
            <label for="exampleFormControlInput1"  class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$data->title }}" name="title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $data->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
            <select class="form-control" value="{{$data->post_creator }}" name="post_creator">
                <option value='{{$data->post_creator}}'>{{$data->post_creator}}</option>
            </select>
        </div>

    <a href="{{ route('post.index') }}" class="btn btn-warning">Back</a>
    <button class="btn btn-primary">Update</button>
    </form>
@endsection
