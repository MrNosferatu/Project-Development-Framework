@extends('user.layouts')
@section('title', 'Register')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-header bg-white text-center">
                <h2 class="card-title">Register</h2>
            </div>
            <div class="card-body pt-5">
                <form method="POST" action="/user/register" class="row g-3 mx-auto">
                    @csrf
                    @method('PUT')
                    <div class="mb-1 mt-0">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 mt-0">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 mt-0">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                            class="form-control" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}"
                            class="form-control" required>
                        @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 mt-0">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}"
                            class="form-control" required>
                        @error('tempat_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                            value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
