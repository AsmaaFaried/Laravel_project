{{--  @extends('layouts.app')  --}}
@section('comments')

<form method="post" action="{{ route('create.comment',['postId'=>$data->id]) }}">
    @csrf
    @method('post')
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Comment creator</label>
        <select class="form-control" name="comment_creator">
            @foreach($users as $user)
                    <option value='{{$user->id}}'>{{$user->email}}</option>
            @endforeach
        </select>
    </div>

<button class="btn btn-success">Post comment</button>
</form>
@show
