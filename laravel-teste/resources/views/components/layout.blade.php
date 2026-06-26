<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
    <title>Management</title>
</head>
<body>
<header class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg container">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('login')}}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('todo.index')}}">Todo</a>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('auth.register')}}">Register</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>
<main class="container py-5">
    {{$slot}}
</main>
<x-alerts></x-alerts>
<script src="{{asset('assets/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
