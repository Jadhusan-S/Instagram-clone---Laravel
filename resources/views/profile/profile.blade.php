@extends('layouts.app')

@section('contents')
    <div class="container">
        <div class="form-group">

            {!!Form::open(array('action' => 'PostsController@store','method' => 'POST', 'enctype'=>'multipart/form-data'))!!}
            <div class="flex-md-row-reverse">
                <div class="col-5">
                    <div class="p-md-5">
    <img src="https://unsplash.it/50" alt="" class="rounded-circle w-50">
</div>
{{Form::file('profile_image')}}
                    
                </div>
                <div class="col-5">

{{Form::text('Firstname', 'Firstname',['class'=>'form-control'])}}
{{Form::text('Lastname', 'Lastname',['class'=>'form-control'])}}
                    
                </div>
            </div>
            {!!Form::close()!!}
        </div>

    </div>
@endsection