@extends('layouts.app')

@section('contents')
<div class="container">
    @php
        $posts = $data['posts']->posts
    @endphp
    <div class="container">
    <h2>{{$data['posts']->Firstname}} {{ $data['posts']->Lastname}}'s Profile</h2>
<hr>
            @if (count($posts)>0)
                @foreach ($posts as $item)
                    <h1><a href="/posts/{{$item->id}}"> {{ $item->title }}</a></h1>
                    <div class="well">{!! $item->description !!}</div>
                @endforeach
            @else 
                <div class="well">No posts</div>
            @endif

    </div>
</div>

@endsection