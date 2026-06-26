@props([
    'method' => 'post',
    'action' => '',
])
<form action="{{$action}}" method="post" enctype="multipart/form-data" {{$attributes->merge()}}>
    @method($method)
    @csrf
    {{$slot}}
</form>
