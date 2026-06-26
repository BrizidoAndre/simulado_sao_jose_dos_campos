<div class="position-fixed end-0 bottom-0 m-5">
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
    @session('message')
    <div class="alert alert-secondary">
        {{$value}}
    </div>
    @endsession
</div>
