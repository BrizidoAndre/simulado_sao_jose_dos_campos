<x-layout-admin>
    <!-- Gallery -->
    <section id="gallery" class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gallery Administration</h2>
            <a href="{{route('photo.create')}}" class="btn btn-dark">
                Upload Image</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Image Name</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($photos as $photo)
                        <tr>
                            <td><img width="300" src="{{asset($photo->image_path)}}" alt="Image preview"></td>
                            <td>{{$photo->image_path}}</td>
                            <td>{{$photo->category?->name ?? 'No category attached'}}</td>
                            <td>
                                <x-form action="{{route('photo.destroy', $photo)}}" method="delete"
                                        onsubmit="return confirm('Are you sure you want to perform this action?')"
                                >
                                    <button class="btn btn-sm btn-outline-danger"> Delete</button>
                                </x-form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layout-admin>
