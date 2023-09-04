<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid">
            <div class="d-flex align-items-center"> <!-- Added this container -->
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('testing.png') }}" alt="" width="30" height="24">
                    <span class="font-italic fw-bold fs-6">Examination Management System</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('Home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('studentRegister') }}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('Student') }}">Student</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+J36Ck3xj3pG8SbCQE5n3g5giF2bK6Pm7uCeC5koD2P5O5l5" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            });
        });
    </script>
</body>

</html>
