<x-layout-admin>
    <h1>Create post</h1>
    <x-form action="{{route('posts.store')}}">
        <!-- Title -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Title </label>
            <input name="title" type="text" class="form-control" placeholder="Enter post title"
                   value="{{old('title','')}}">
        </div>
        <!-- Category -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Category </label>
            <select class="form-select" name="category_id">
                <option value="" selected> Select category</option>
                @foreach(\App\Models\Category::pluck('name','id') as $key=> $category)
                    <option value="{{$key}}"> {{$category}}</option>
                @endforeach
            </select>
        </div>
        <!-- Featured Image -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Featured Image </label>
            <input type="file" class="form-control" name="image_path">
        </div>
        <!-- Content -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Content </label>
            <textarea class="form-control" rows="10" name="content"
                      placeholder="Write the post content here..."></textarea>
        </div>
        <!-- Actions -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark"> Save Post</button>
            <a href="{{route('posts.index')}}"
               class="btn btn-outline-secondary">
                Cancel
            </a>
        </div>
    </x-form>
</x-layout-admin>
