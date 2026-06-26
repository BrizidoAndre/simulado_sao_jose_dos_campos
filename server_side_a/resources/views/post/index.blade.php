<x-layout-admin>
    @php
        $status = [
            'Published' => 'text-bg-success',
            'Draft' => 'text-bg-warning',
]
    @endphp
        <!-- Posts -->
    <section id="posts" class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Posts Administration</h2>
            <a href="{{route('posts.create')}}" class="btn btn-dark">
                New Post
            </a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category?->name ?? 'No category attached'}}</td>
                            <td><span class="badge {{$status[$post->status]}}"> {{$post->status}} </span></td>
                            <td>{{$post->published_at?->format('d/m/Y') ?? ''}}</td>
                            <td class="hstack gap-2">
                                <a href="{{route('posts.update', $post)}}" class="btn btn-sm btn-outline-dark"> Edit</a>
                                <x-form action="{{route('posts.destroy', $post)}}" method="delete"
                                        onsubmit="return confirm('Are you sure you want to perform this action?')">
                                    <button
                                        class="btn btn-sm btn-outline-danger"> Delete
                                    </button>
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
