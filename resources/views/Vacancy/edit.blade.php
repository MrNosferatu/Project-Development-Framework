@extends('layouts.main')
@section('title', 'Edit Vacancy')

@section('content')
    <div class="container">
        <h1 class="my-5">Job Vacancy Edit</h1>
        @foreach ($vacancy as $vacancy)
            <form action="" method="post">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="title" name="title" required
                        value="{{ $vacancy->title }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Job Description</label>
                    <textarea class="form-control" name="description" rows="5" required>{{ $vacancy->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Job Type</label>
                    <select class="form-select" id="type" name="type" required>
                        <option value="Full-time" selected>Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Contract">Contract</option>
                        <option value="Freelance">Freelance</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="salary" class="form-label">Job Salary</label>
                    <input type="number" class="form-control" id="salary" name="salary" required
                        value="{{ $vacancy->salary }}">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <select class="form-select" id="location" name="location" required>
                        <option value="">Location</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                        <option value="Jawa Tengah">Jawa Tengah</option>
                        <option value="Jawa Timur">Jawa Timur</option>
                        <option value="D.I. Yogyakarta">D.I. Yogyakarta</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
    </div>
    @endforeach
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@stop
