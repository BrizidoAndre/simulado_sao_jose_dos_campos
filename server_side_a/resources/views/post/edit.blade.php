<x-layout-admin>
    <h1>Update post</h1>
    <x-form action="{{route('posts.update', $post)}}" method="put">
        <!-- Title -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Title </label>
            <input name="title" type="text" class="form-control" placeholder="Enter post title"
                   value="{{old('title',$post->title)}}">
        </div>
        <!-- Category -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Category </label>
            <select class="form-select" name="category_id">
                <option @selected($post->category_id === null) value="" selected> Select category</option>
                @foreach(\App\Models\Category::pluck('name','id') as $key=> $category)
                    <option @selected($post->category_id === $key) value="{{$key}}"> {{$category}}</option>
                @endforeach
            </select>
        </div>
        <!-- Status -->
        <div class="mb-4">
            <label class="form-label fw-semibold"> Status </label>
            <select class="form-select" name="status">
                <option value="Draft" selected> Draft</option>
                <option @selected($post->status === 'Published') value="Published"> Published</option>
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
                      placeholder="Write the post content here...">{{$post->content}}</textarea>
        </div>
        <!-- Actions -->
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-dark"> Save Post</button>
            <a href="{{route('posts.index')}}"
               class="btn btn-outline-secondary">
                Cancel
            </a>
            <a href="{{route('post.toggle', $post)}}" class="btn btn-secondary">Toggle Status</a>
        </div>
    </x-form>
</x-layout-admin>
