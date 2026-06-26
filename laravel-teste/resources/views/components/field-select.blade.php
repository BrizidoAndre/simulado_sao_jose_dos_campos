@props([
    'name',
    'id' => $name,
    'label' => '',
])
<div class="mb-3">
    <label for="{{$id}}" class="form-label">{{$label}}</label>
    <select name="{{$name}}" id="{{$id}}" {{$attributes->merge([
    'class'=> 'form-select',
])}}>
        {{$slot}}
    </select>
</div>
