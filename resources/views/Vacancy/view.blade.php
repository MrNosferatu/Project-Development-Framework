@extends('layouts.main')
@section('title', 'View Vacancy')

@section('content')
    <div style="width:70vw" class="mx-auto">

    </div>
    <div style="width:70vw" class="mx-auto">
        @foreach ($vacancy as $vacancy)
            <div class="card">
                <div class="card-header">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmation">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin ingin menghapus lowongan "{{ $vacancy->title }}"?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="/vacancy/delete/{{ $vacancy->id }}" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/vacancy/edit/{{ $vacancy->id }}" class="btn btn-warning">edit</a>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </div>
@stop
