@extends('layouts.app')
@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
<h3 class="align-content-lg-center font-weight-bold " >Posts</h3>
{!! Form::open(array('action' => 'PostsController@store','method' => 'POST', 'enctype'=>'multipart/form-data')) !!}
<div class="form-group">
    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Some text'])}}
</div>
{{-- <div class="form-group">
    {{Form::textarea('body', '',['id'=>'article-ckeditor','placeholder'=>'Some text'])}}
</div> --}}
<div class="form-group">
    {{Form::file('post_image')}}
</div>
{{-- {{Form::hidden('USER_ID', '{{Auth::user()->id}}')}} --}}
<div class="form-group">    
    {{Form::submit('Submit Form',['class'=>'btn btn-default '])}}
</div>
{!! Form::close() !!}

</div>
</div>
</div>
</div>
</div>

@endsection