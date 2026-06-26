@php
    $status = [
        'pending' => 'secondary',
        'doing' => 'warning',
        'done' => 'success'
    ]
@endphp
<x-layout>
    <h1>Todo</h1>
    <x-form action="{{route('todo.store')}}">
        <x-field name="title">Title</x-field>
        <x-field name="content">Content</x-field>
        <button class="btn btn-primary">Submit</button>
    </x-form>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($todos as $todo)
            <tr>
                <td>{{$todo->title}}</td>
                <td>{{$todo->content}}</td>
                <td>
                    <span class="badge text-bg-{{$status[$todo->status]}}">
                        {{$todo->status}}
                    </span>
                </td>
                <td class="hstack gap-2">
                    <a href="{{route('todo.edit', $todo)}}" class="btn btn-secondary">Edit</a>
                    <x-form method="delete" action="{{route('todo.destroy', $todo)}}">
                        <button class="btn btn-danger">Delete</button>
                    </x-form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
