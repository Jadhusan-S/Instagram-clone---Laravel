@if (session('success'))
    <div class="alert-danger">
        {{session('success')}}
    </div>
@elseif(session('error'))
        <div class="alert-danger">
        {{session('error')}}
    </div>
@endif