@extends('layouts.app')

@section('contents')
@php
    $post_id = $data['post']->id;
    $names = '';
    $posted_date = date('d',strtotime($data['post']->created_at));
    $today = date('d');
    $temp = $today - $posted_date;
    $current_date = $temp.' '.$today. ' - '.$posted_date;
    if ($temp == 0){
        $current_date =  date('i', time()) - date('i' ,strtotime($data['post']->created_at)).' mins ago';
    }
    elseif ($temp>=7) {
        $current_date = '1 week ago';
    }
    elseif ($temp>=14) {
        $current_date = '2 weeks ago';
    }
@endphp
    <div style="display:flex">
        {{-- image --}}
        <div class=" w-50 " style="margin:25px">
            <div class="card-img">
            <img src="/images/{{$data["post"]->img_name}}" class=" w-100 h-auto">
            </div>
        </div>
        {{-- details --}}
        <div class="w-50" style="margin:25px">
            <h3>
                <img src="/images/{{$data['post']->img_name}}" width="25px" height="25px" style="border-radius:100%;overflow:hidden">
                <a href="/profile/viewprofile/{{$data['post']->user->id}}">{{$data['created_by']}}</a> 
                {{ $data['post']->title }}</h3>
            
            <p> 
                
                @if ($data['liked_by'][0]=='No one')
                    {{'0 Likes'}}     
                @else
                    {{$data['likes']}} Likes 
                    <strong> , Liked by 
                        @foreach ($data['liked_by'] as $name)
                        @php
                        $names .= $name.' , ';
                        @endphp
                        @endforeach
                        {{rtrim($names, ' , ')}}
                    </strong>
                @endif
            </p>

            @guest
                <p>please login or sign up to like posts</p>
            @else
            {{-- like --}}
            {!! Form::open(array('action' => 'LikesController@onlike','method' => 'POST')) !!}
                {{Form::submit('Like',['class'=>'btn btn-default'])}}
                {{Form::hidden('POST_ID',$post_id)}}
            {!! Form::close()!!}
        
            @if ($data['comments'][0]=='No comments')
                {{'No comments'}}
            @else
                <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="figure-caption FontSmall btn-light border-0">
                     View all {{count($data['comments'])}} Comment's
                </button>
            @endif
            {{-- comment --}}
            {!! Form::open(array('action' => 'CommentsController@onsubmit','method' => 'POST')) !!}
                {{Form::text('comment','',['class'=>'form-control'])}}
                {{Form::submit('post_comment',['class'=>'btn btn-default'])}}
                {{Form::hidden('POST_ID',$post_id)}}
            {!! Form::close()!!}
        @endguest
                <p class="figure-caption">{{$current_date}}</p>
        </div>
    </div>


        <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">
                    @if ($data['comments'][0]=='No comments')
                        {{'No comments'}}
                    @else
                    @for ($i = 0; $i < count($data['comments']); $i++)
                            <p> 
                                <img src="/images/{{$data['post']->img_name}}" width="25px" height="25px" style="border-radius:100%;overflow:hidden">
                                <a href="/profile/viewprofile/{{$data['comments'][$i]['id']}}">{{$data['comments'][$i]['by']}}</a> 
                                {{$data['comments'][$i]['comment']}}
                            </p>
                            <p class="figure-caption FontSmall">
                                {{date('d-M-Y',strtotime($data['post']->created_at))}} 
                            </p>
                    @endfor
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


