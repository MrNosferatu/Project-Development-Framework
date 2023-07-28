@extends('layouts.main')
@section('title', 'View Vacancy')

@section('content')
    <div style="width:70vw;" class="mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="card-text">{{ $vacancy->title }}</h4>
            </div>
            <div class="card-body">
                <p class="card-text">Lokasi : {{ $vacancy->location }}</p>
                <p class="card-text">Jenis :</br>{{ $vacancy->type }}</p>
                <p class="card-text">Deskripsi pekerjaan </br>{{ $vacancy->description }}</p>
                <p class="card-text">Gaji : {{ $vacancy->salary }}</p>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmation">
                    Apply
                </button>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-header">
                <h5>Informasi Perusahaan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col col-1">
                        <img src="{{ asset('images/' . $company->image) }}" class="card-img-top" alt="...">
                    </div>
                    <div class="col">
                        <h6 class="card-text">{{ $company->nama_badan_usaha }}</h6>
                        <p class="card-text">{{ $company->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="/vacancy/{{ $vacancy->id }}/apply" method="post">
                        @csrf
                        @method('POST')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">confirmation</h5>
                        </div>
                        <div class="modal-body">
                            <p>Apply for {{ $vacancy->title }}?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Yes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
