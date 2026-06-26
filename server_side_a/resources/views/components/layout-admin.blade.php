<x-layout>
    <main class="d-flex flex-nowrap" style="min-height: 100vh;">
        <!-- Sidebar -->
        <div class=" d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px">
            <a href="{{route('admin.index')}}"
               class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4">PhotoPortal</span>
            </a>
            <hr/>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="{{route('posts.index')}}" class="nav-link text-white">
                        Posts
                    </a>
                </li>
                <li>
                    <a href="{{route('category.index')}}" class="nav-link text-white">
                        Categories
                    </a>
                </li>
                <li>
                    <a href="{{route('photo.index')}}" class="nav-link text-white">
                        Gallery
                    </a>
                </li>
                <li>
                    <a href="{{route('contact.index')}}" class="nav-link text-white">
                        Contacts
                    </a>
                </li>
            </ul>
            <hr/>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a></li>
                </ul>
            </div>
        </div>

        <div class="px-4 flex-grow-1">
            {{$slot}}
        </div>
    </main>
</x-layout>
