@extends('layouts.blog.app')

@section('content')

        <div style="display:none" class="alert alert-danger errors-create">
            <ul>

            </ul>
        </div>

    <form id="add-post" method="post" action="create" enctype="multipart/form-data">
        @csrf
        <input type="text" class="form-control title" placeholder="Title">
        <div id="body" name="body"></div>
        <a href="/" class="btn btn-outline-danger">Cancel</a>
        <input type="submit" class=" btn btn-success" value="Save">
    </form>
@endsection