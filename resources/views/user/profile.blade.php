@extends('layouts.main')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Profile</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        {{-- <div class="col-md-4">
            // show user profile image
            <img src="{{ asset('uploads/profile') }}/{{ Auth::user()->image }}" width="100%" alt="">
        </div> --}}
        <div class="col-md-8">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Pendidikan</th>
                        <td>{{ $user->pendidikan }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $user->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->no_telp }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="/profile/edit" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>
@endsection