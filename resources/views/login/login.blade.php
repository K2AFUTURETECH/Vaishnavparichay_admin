@extends('layout.admin.loginlayout')


@section('login')
    <div class="loginbox">
        <img src="{{ asset('assets1/img/logo.png') }}" alt="Logo" class="img-fluid" style="height: 60%;">
        {{-- <h3>Sign In To Admin</h3> --}}


        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show alert-sm" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show alert-sm" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif


        <form method="post" action="{{ route('adminlogin') }}">
            @csrf
            <label class="login" for="email">Username</label>
            <input type="text" name="email" id="email" placeholder="Enter Username"
                class="form-control @error('email') is-invalid @enderror" />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <label class="login" for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter Password"
                class="form-control @error('password') is-invalid @enderror" />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <input type="submit" value="Login">
            {{-- <a href="">Forgot password?</a><br> --}}
        </form>
    </div>

@endsection
