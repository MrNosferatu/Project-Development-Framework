@extends('layouts.main')
@section('title', 'GradJobs')

@section('content')
    <form action="/search" method="post">
        @csrf
        <div class="input-group mb-3 mx-auto" style="width:40vw">
            <input type="text" class="form-control" aria-label="Text input with dropdown button" name="query">
            <select class="form-select" aria-label="Default select example" name="type">
                <option value="any" selected>Jenis</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
                <option value="Freelance">Freelance</option>
            </select>
            <button class="btn btn-primary">Search</button>
        </div>
    </form>
    <div class="mx-auto">
        <div class="row">
            @foreach ($vacancy as $vacancy)
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop
