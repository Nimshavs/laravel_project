@extends('layout')
@section('title', 'Student Login')
@vite(['resources/css/login.css'])
@section('content')
    <div class="container" style="padding: 10%">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center bg-dark bg-opacity-75">
                        <h4 class=" text-white">Forget Password</h4>
                    </div>
                    <div class="card-body bg-primary" style="--bs-bg-opacity:.5">
                        @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('forgetPassword') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autocomplete="off" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password" autocomplete="off" required>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit" class="btn btn-light rounded-pill">Forget Password</button>
                            </div>
                        </form>
                        <div>
                            <a href="/login">
                            <button type="submit" class="btn btn-outline-dark btn-sm">Back</button>
                        </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
