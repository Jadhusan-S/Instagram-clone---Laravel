@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                {{-- CREATE NEW POST --}}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-default">Create post</a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Posts</div>
                {{-- YOUR POSTS --}}
                <div class="card-body">
                        @php
                            $posts = Auth::user()->posts
                        @endphp
                        @if (count($posts)>0)
                            @foreach ($posts as $item)
                                
                                <div class="card-img">
                                <img src="images/{{$item->img_name}}" class="img-thumbnail w-50 h-50">
                                <p><a href="/posts/{{$item->id}}"> {{ $item->title }}</a></p>
                                </div>
                            @endforeach
                        @else 
                            <div class="well">No posts</div>
                        @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
