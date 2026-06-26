<x-layout>
    <h1>Edit</h1>
    <x-form action="{{route('todo.update', $todo)}}" method="put">
        <x-field value="{{old('title', $todo->title)}}" name="title">Title</x-field>
        <x-field value="{{old('content', $todo->content)}}" name="content">Content</x-field>
        <x-field-select name="status" label="Status">
            <option @selected(old('status','') === $todo->status) value="pending">Pending</option>
            <option @selected(old('status','') === $todo->status) value="doing">Doing</option>
            <option @selected(old('status','') === $todo->status) value="done">Done</option>
        </x-field-select>
        <button class="btn btn-primary">Edit</button>
    </x-form>
</x-layout>
