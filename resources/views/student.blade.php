@extends('layout')
@section('title', 'Student Login')
@section('content')
    <center>
        <div class="form_deg">
            <form class="login">
                <center class="heading">
                    Login Form
                </center>
                <div>
                    <label class="label">Username</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <label class="label">Password</label>
                    <input type="text" name="password">
                </div>
                <div>
                    <button class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </center>
@endsection
