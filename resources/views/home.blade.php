@extends('layouts.main')
@section('title', 'GradJobs')

@section('content')
    <form id="search-form">
        @csrf
        <div class="input-group mb-3 mx-auto">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop
