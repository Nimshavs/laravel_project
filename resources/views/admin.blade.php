@extends('layout')
@section('title', 'Admin Login')
@vite(['resources/css/login.css'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-black">
                        <h4 class="bg-black text-white">Login Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('studentRegister') }}" method="POST" id="registrationForm">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Confirm your password" autocomplete="off">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
