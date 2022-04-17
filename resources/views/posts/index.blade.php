@extends('layouts.app')
@section('title') Index @endsection
@section('content')

<div class="text-center">
    <a href="{{ route('post.create') }}" class="mt-4 btn btn-success">Create Post</a>
</div>
<table class=" table mt-4">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        
        @foreach ($posts as $post )
      <tr>
        <td>{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        @if($post->user)
        <td>{{ $post->user->name}}</td>
        @else
        <td>Not Found</td>
        @endif
        <td>{{ $post->created_at }}</td>
        <td>
            <a href="{{ route('post.show',['post'=>$post['id']]) }}" class="btn btn-info">View</a>
            <a href="{{ route('post.edit',['postId'=>$post['id']]) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('post.delete',['postId'=>$post['id']]) }}"  class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection
