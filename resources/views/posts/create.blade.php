@extends('layouts.app')
@section('title') Create @endsection

@section('content')

    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label font-weight-bold">Upload Image</label>
            <input type="file" class="form-control" id="exampleFormControlInput1"  name="PostImage">

        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1"  class="form-label font-weight-bold">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"  name="title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label font-weight-bold">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label font-weight-bold">Post Creator</label>
            <select class="form-control" name="post_creator">
                  @foreach($users as $user)
                    <option value='{{$user->name}}'>{{$user->name}}</option>
                  @endforeach


            </select>
        </div>

    <a href="{{ route('post.index') }}" class="btn btn-warning">Back</a>
    <button type="submit" class="btn btn-success">Create</button>
    </form>

@endsection
