@extends('layouts.blog.app')

@section('content')
<div class=”title m-b-md”>
    You cannot access this page! This is for only "{{$role}}"
    <a href="{{ URL::previous() }}">Back</a>
</div>
@endsection