<x-layout-public>
    <div class="container py-5">
        <h1 class="mb-4">Gallery</h1>
        <div class="row g-3">
            @foreach(\App\Models\Photo::all() as $photo)
                @php
                    $customId = \Illuminate\Support\Str::ulid();
                @endphp
                <button data-bs-toggle="modal" data-bs-target="#{{$customId}}" class="col-md-4 btn">
                    <img
                        src="{{$photo->image_path}}" alt="Image preview"
                        class="img-fluid w-100 rounded">
                </button>
                <!-- Modal -->
                <div class="modal fade" id="{{$customId}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="btn btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <img
                                src="{{$photo->image_path}}" alt="Image preview"
                                class="img-fluid w-100 rounded">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layout-public>
