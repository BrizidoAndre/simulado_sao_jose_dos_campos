<x-layout-public>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9 my-5"> <!-- Post Header -->
                <div class="mb-4">
                    @if($post->category)
                        <span class="badge bg-dark mb-3">{{$post->category->name}}</span>
                    @endif
                    <h1 class="display-5 fw-bold mb-3"> {{$post->title}} </h1>
                    <div class="d-flex align-items-center text-muted small">
                        <span>{{$post->published_at?->format('F d\, Y')}}</span>
                    </div>
                </div>
                <!-- Featured Image -->
                <div class="mb-5">
                    <img src="{{asset($post->image_path)}}" alt="Photography Post"
                         class="img-fluid rounded shadow-sm w-100">
                </div>
                <!-- Post Content -->
                <article>
                    <p class="lead mb-4">{!!$post->content!!}</p>
                </article>
            </div>
        </div>
    </div>
</x-layout-public>
