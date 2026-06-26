<x-layout-public>
    <div class="container py-5">
        <h1 class="mb-4">Posts</h1>

        @foreach($posts as $post)
            <div class="card mb-3">
                <img src="{{asset($post->image_path)}}"
                     style="max-height: 300px;object-fit: cover;object-position: center;"
                     class="card-img-top" alt="Post Image">
                <div class="card-body">
                    <h3>{{$post->title}}</h3>
                    <p>{{ \Illuminate\Support\Str::substr($post->content,0,70) }}...</p>
                    <a href="{{route('public.posts.show', $post)}}" class="btn btn-dark">Read More</a>
                </div>
            </div>
        @endforeach
    </div>
</x-layout-public>
