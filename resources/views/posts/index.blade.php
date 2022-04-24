@extends('layouts.app')
@section('title') Index @endsection
@section('content')

<div class="text-center">
    <a href="{{ route('post.create') }}" class="mt-4 btn btn-success">Create Post</a>
</div>
<form method="post" action="{{ route('old.posts') }}" class="text-center">
    @csrf
    @method('delete')
    <h5>Delete all posts that are created from 2 years ago </h5>
<button type="submit"  class="btn btn-danger mx-4" onclick="return confirm('Are you sure to remove posts?')">Remove</button>
</form>
<table class=" table mt-4 table-dark">
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">PostImage</th>
        <th scope="col">Slug</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>

        @foreach ($posts as $post )

      <tr>
        <td>{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td><img style="width:100px;height:100px;" src="{{ asset('storage/PostImages/'.$post->PostImage) }}" alt="postImage" title="postImage"></td>
        <td>{{ $post->slug }}</td>
        @if($post->user)
        <td>{{ $post->user->name}}</td>
        @else
        <td>Not Found</td>
        @endif
        <td>{{ $post->created_at->isoFormat('YYYY-MM-D') }}</td>

        <td >

            <a href="{{ route('post.show',['slug'=>$post['slug']]) }}" class="btn btn-info mx-4">View</a>
            <a href="{{ route('post.edit',['slug'=>$post['slug'] ]) }}" class="btn btn-primary mx-4" >Edit</a>
            <form method="post" action="{{ route('post.delete',['postId'=>$post['id'] ]) }}" style="display: inline-block;">
                @csrf
                @method('delete')
            <button type="submit"  class="btn btn-danger mx-4" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
        </td>

      </tr>
      @endforeach

    </tbody>
  </table>

  {{ $posts->links() }}
@endsection
