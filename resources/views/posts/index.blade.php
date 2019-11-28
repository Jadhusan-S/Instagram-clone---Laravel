@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row">
            <div class="panel panel-default">

                <div style="display:flex; flex-direction:column;justify-content:center;align-items:center" class="m-md-5">
                    <div class="panel-heading">Posts </div>
                    @if (count($post)>0)
                    @foreach ($post as $item)
                        {{-- image --}}
                        <div class="w-50 " style="background-color:#f1f1f1; padding:10px;margin-bottom:10px">
                            <p>
                            <div class="top-section" >
                                <img src="/images/{{$item->img_name}}" width="25px" height="25px" style="border-radius:100%;overflow:hidden">
                                <a href="/profile/viewprofile/{{$item->user->id}}">{{$item->user->Firstname}}</a>
                            </div>
                            </p>
                            <div class="card-img" >
                                <a href="/posts/{{$item->id}}">
                                    <img src="/images/{{$item->img_name}}" class="w-100 h-auto">
                                </a>
                            </div>
                            <div>
                            <p>15 Likes</p>
                            <p>
                                <a href="/profile/viewprofile/{{$item->user->id}}">{{$item->user->Firstname}}</a>
                                {{ $item->title }}
                            </p>
                            <p class="figure-caption">4 comments</p>
                            </div>
                        </div>


                    @endforeach
                    @else 
                        <p>No posts</p>
                    @endif
                </div>
        </div>
    </div>
</div>


@endsection