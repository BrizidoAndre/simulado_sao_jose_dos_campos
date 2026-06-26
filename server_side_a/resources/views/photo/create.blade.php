<x-layout-admin>
    <h1>Create photo</h1>
    <x-form action="{{route('photo.store')}}">
        <!-- Image -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Image </label>
            <input type="file" class="form-control" name="image_path">
        </div>
        <!-- Category -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Category </label>
            <select class="form-select" name="category_id">
                <option selected value=""> Select category</option>
                @foreach(\App\Models\Category::pluck('name','id') as $key => $category)
                    <option value="{{$key}}">{{$category}}</option>
                @endforeach
            </select>
        </div>
        <!-- Actions -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark"> Save Image</button>
            <a href="{{route('photo.index')}}" type="button" class="btn btn-outline-secondary"> Cancel</a>
        </div>
    </x-form>
</x-layout-admin>
