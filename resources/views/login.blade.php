@extends('layout')
@section('title', 'Student Login')
@vite(['resources/css/login.css'])
@section('content')
    <div class="container" style="padding: 15%">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" style="background-color: brown">
                        <h4 class=" text-white">Login Form</h4>
                    </div>
                    <div class="card-body" style="background-color:burlywood">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autocomplete="off" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password" autocomplete="off" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-light rounded-pill">Login</button>
                            </div>
                        </form>
                        <a href="/forget-password" >Forget Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
