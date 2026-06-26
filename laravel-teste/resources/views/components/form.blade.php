@props([
    'method' => 'post',
    'action',
])
<form action="{{$action}}" method="post">
    @method($method)
    @csrf
    {{$slot}}
</form>
