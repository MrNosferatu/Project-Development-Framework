@extends('user.layouts')
@section('title', 'Login')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-header bg-white text-center">
                <h2 class="card-title">Login</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="/user/login" class="row g-3 mx-auto">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Login</button>
                        <a class="btn btn-light" href="/register">Signup</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
