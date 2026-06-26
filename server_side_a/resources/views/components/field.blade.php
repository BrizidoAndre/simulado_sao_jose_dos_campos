@props([
    'name',
    'id' => $name
])
<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$slot}}</label>
    <input {{$attributes->merge([
    'class' => 'form-control',
    'id' => $id,
    'name' => $name,
    'value'=> old($name, '')
])}}>
</div>
