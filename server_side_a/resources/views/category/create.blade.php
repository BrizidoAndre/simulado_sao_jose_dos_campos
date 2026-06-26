<x-layout-admin>
    <h1>Create category</h1>
    <x-form action="{{route('category.store')}}">
        <!-- Name -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Name </label>
            <input type="text" class="form-control" placeholder="Enter category name" value="{{old('name','')}}" name="name">
        </div>
        <!-- Actions -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark"> Save Category</button>
            <a href="{{route('category.index')}}" type="button" class="btn btn-outline-secondary"> Cancel</a>
        </div>
    </x-form>
</x-layout-admin>
