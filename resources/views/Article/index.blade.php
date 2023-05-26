@extends('layouts.main')
@section('title', 'Article | GradJobs')

@section('content')
    <!-- <form action="/articlePost" method="post"> -->
    @csrf
    <!-- <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea type="text" class="form-control" name="description" id="description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form> -->
    <div style="width:70vw" class="mx-auto">
        <div class="row">
            @foreach ($article as $article)
                <div class="col-6 p-2">

                    <div class="card">
                        <h5 class="card-header">{{ $article->title }}</h5>
                        <div class="card-body">
                            <p class="card-text">{{ $article->description }}</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text">Lokasi : {{ $article->id }}</p>
                        </div>
                        <a href="/article/{{ $article->id }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@stop
