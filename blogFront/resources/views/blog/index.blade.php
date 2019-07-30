@extends('layouts.blog.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('blog.includes.addpost')

    <div class="row">

        <div class="col-8">
            @foreach($posts as $post)
            <div class="card">
                <div class="card-body">

                    <div class="blog-post">
                        <h2 class="blog-post-title">{{$post->title}}</h2>
                        <p class="blog-post-meta">{{ date("F jS, Y", strtotime($post->updated_at)) }} <a href="#">Mark</a></p>

                        {!! $post->body !!}
                    </div>

                    <hr>
                    @guest

                    @else
                        @if (Auth::user()->author_id ==  $post->author_id )
                            <a href="#" class="edit-post btn btn-outline-warning">Edit</a>
                            <a href="#" class="delete-post btn btn-outline-danger">Delete</a>
                        @endif
                    @endguest
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-3">

                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="font-italic">About</h4>
                    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
                </div>

                <div class="p-4">
                    <h4 class="font-italic">Archives</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="#">March 2014</a></li>
                        <li><a href="#">February 2014</a></li>
                        <li><a href="#">January 2014</a></li>
                        <li><a href="#">December 2013</a></li>
                        <li><a href="#">November 2013</a></li>
                        <li><a href="#">October 2013</a></li>
                        <li><a href="#">September 2013</a></li>
                        <li><a href="#">August 2013</a></li>
                        <li><a href="#">July 2013</a></li>
                        <li><a href="#">June 2013</a></li>
                        <li><a href="#">May 2013</a></li>
                        <li><a href="#">April 2013</a></li>
                    </ol>
                </div>

                <div class="p-4">
                    <h4 class="font-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>

        </div>
    </div>
@endsection