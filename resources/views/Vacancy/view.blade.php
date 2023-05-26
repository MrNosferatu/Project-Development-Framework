@extends('layouts.main')
@section('title', 'View Vacancy')

@section('content')
    <div style="width:70vw" class="mx-auto">

    </div>
    <div style="width:70vw" class="mx-auto">
        @foreach ($vacancy as $vacancy)
            <div class="card">
                <div class="card-header">
                <a href="/vacancy/delete/{{$vacancy->id}}" class="btn btn-danger">Delete</a>
                <a href="/vacancy/edit/{{$vacancy->id}}" class="btn btn-warning">edit</a>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $vacancy->title }}</p>
                    <p class="card-text">Lokasi : {{ $vacancy->location }}</p>
                    <p class="card-text">Jenis :</br>{{ $vacancy->type }}</p>
                    <p class="card-text">Deskripsi pekerjaan </br>{{ $vacancy->description }}</p>
                    <p class="card-text">Kualifikasi : </br>{{ $vacancy->qualification }}</p>
                    <p class="card-text">Gaji : {{ $vacancy->salary }}</p>

                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary">Apply</a>
                </div>
            </div>
        @endforeach
    </div>
    @stop
