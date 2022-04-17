@extends('layouts.app')
@section('title') Create @endsection

@section('content')
   
    <form method="POST" action="{{ route('post.store') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1"  class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1"  name="title">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descrip"></textarea>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
            <select class="form-control" name="post_creator">
                  {{--  @foreach($posts as $post)
                    <option value='{{$post['id']}}'>{{$post['post_creator']}}</option>
                  @endforeach  --}}
                  <option value='Ahmed'>Ahmed</option>
                  <option value='Mohamed'>Mohamed</option>
                  <option value='Ali'>Ali</option>

            </select>
        </div>
        
        {{--  <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
            <input type="text" class="form-control" id="exampleFormControlTextarea1" name="post_creator">
        </div>  --}}
    <a href="{{ route('post.index') }}" class="btn btn-warning">Back</a>
    <button class="btn btn-success">Create</button>
    </form>
@endsection
