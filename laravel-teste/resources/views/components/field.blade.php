@props([
    'name',
    'id' => $name
])
<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$slot}}</label>
    <input name="{{$name}}" id="{{$id}}" {{$attributes->merge([
    'type' => 'text',
    'class' => 'form-control',
])}}>
</div>
