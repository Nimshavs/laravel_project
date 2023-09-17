<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+J36Ck3xj3pG8SbCQE5n3g5giF2bK6Pm7uCeC5koD2P5O5l5" crossorigin="anonymous">
    </script> --}}
    {{-- <link rel="stylesheet" href=".project/resources/css/home.css"> --}}

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar navbar-light fixed-top" style="background-color:brown ">
        <div class="container-fluid">
            <div class="d-flex align-items-center"> <!-- Added this container -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('testing.png') }}" alt="" width="30" height="24">
                    <span class="fs-6 fw-semibold">Examination Management System</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon slide"></span>
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
    <main class="main" style="background: url({{ asset('exam.jpg') }})">
        @yield('content')
        </div>

        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
