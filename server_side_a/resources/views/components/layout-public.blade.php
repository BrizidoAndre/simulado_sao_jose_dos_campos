<x-layout>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{route('public.index')}}">PhotoPortal</a>

            <div>
                <a class="nav-link text-white d-inline" href="{{route('public.gallery')}}">Gallery</a>
                <a class="nav-link text-white d-inline" href="{{route('public.posts')}}">Posts</a>
            </div>
        </div>
    </nav>
    {{$slot}}
    <footer class="bg-dark text-white text-center py-4">
        <h5 class="mb-3">PhotoPortal</h5>
        <p class="mb-2"> Sharing photography stories, inspiration and creative experiences. </p>
        <small> © 2026 PhotoPortal. All rights reserved. </small>
    </footer>
</x-layout>
