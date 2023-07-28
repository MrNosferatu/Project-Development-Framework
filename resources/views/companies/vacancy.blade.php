@extends('layouts.main')
@section('title', 'Vacancy')

@section('content')
    <div class="mx-auto">
    <a href="/vacancy/create" class="btn btn-primary">Create Vacancy</a>
        <div class="row">
            @foreach ($vacancies as $vacancy)
                <div class="col-6 p-2">
                    <div class="card">
                        <h5 class="card-header">{{ $vacancy->title }}</h5>
                        <div class="card-body">
                            <p class="card-text">{{ $vacancy->type }}</p>
                            <p class="card-text">Rp. {{ $vacancy->salary }}</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">Lokasi : {{ $vacancy->location }}</p>
                        </div>
                        <a href="vacancy/{{ $vacancy->id }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
