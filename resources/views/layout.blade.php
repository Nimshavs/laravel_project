<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    @vite(['resources/css/home.css'])
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary " style="--bs-bg-opacity:.75">
        <div class="container-fluid">
            <div class="d-flex align-items-center"> <!-- Added this container -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('testing.png') }}" alt="" width="30" height="24">
                    <span class="fs-6 fw-semibold">Examination Management System</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('Home') ? 'active-link' : '' }} {{ request()->is('Home') ? 'selected-link' : '' }}"
                            href="{{ route('Home') }}">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin') ? 'active-link' : '' }} {{ request()->is('admin') ? 'selected-link' : '' }}"
                            href="{{ route('admin') }}">Register</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active-link' : '' }} {{ request()->is('login') ? 'selected-link' : '' }}"
                            href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <img src="{{ URL('exam.jpg') }}" alt="" width="100%" height="100%">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+J36Ck3xj3pG8SbCQE5n3g5giF2bK6Pm7uCeC5koD2P5O5l5" crossorigin="anonymous">
    </script>
</body>

</html>
