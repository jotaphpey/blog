@extends('layouts.blog.app')

@section('content')

    <div class="row">
        <form method="post" action="update-author" enctype="multipart/form-data">
            @csrf
            <img class="" src="data:image/png;base64,{{$author->image}}">
            <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Username" value="{{$author->username}}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection