<x-layout-admin>
    <!-- Categories -->
    <section id="categories" class="mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Categories Administration</h2>
            <a href="{{route('category.create')}}" class="btn btn-dark"> New Category</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Category::all() as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td class="hstack gap-2">
                                <a href="{{route('category.show', $category)}}"
                                   class="btn btn-sm btn-outline-dark">Edit</a>
                                <x-form action="{{route('category.destroy', $category)}}" method="delete"
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
