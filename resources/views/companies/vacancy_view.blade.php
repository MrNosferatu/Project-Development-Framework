@extends('layouts.main')
@section('title', 'View Vacancy')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div style="width:70vw" class="mx-auto">
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
                <p class="card-text">Gaji : {{ $vacancy->salary }}</p>

            </div>
        </div>
        <br>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">CV</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <h4 class="text-center">Daftar Pelamar</h4 class="text-center">
                    @forelse ($applications as $application)
                        <tr data-id="{{ $application->id }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $application->name }}</td>
                            <td>{{ $application->email }}</td>
                            <td><a class="btn btn-success" href="{{ route('download.cv', $application->cv) }}">Download</a>
                            </td>
                            <td>
                                <select name="status" id="status-{{ $application->id }}" class="form-control"
                                    target="_blank">
                                    <option value="diproses" {{ $application->status == 'diproses' ? 'selected' : '' }}>
                                        Diproses</option>
                                    <option value="wawancara" {{ $application->status == 'wawancara' ? 'selected' : '' }}>
                                        Wawancara</option>
                                    <option value="ditolak" {{ $application->status == 'ditolak' ? 'selected' : '' }}>
                                        Ditolak</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="keterangan" id="keterangan-{{ $application->id }}"
                                    value="{{ $application->keterangan }}" class="form-control">
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary save-btn"
                                    data-id="{{ $application->id }}">Save</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Belum ada lamaran</td>
                        </tr>
                    @endforelse
                </tbody>
                <script>
                    $(document).ready(function() {
                        $('.save-btn').on('click', function() {
                            var id = $(this).data('id');
                            var status = $('#status-' + id).val();
                            var keterangan = $('#keterangan-' + id).val();

                            $.ajax({
                                url: '/lamaran/edit/' + id,
                                type: 'PUT',
                                data: {
                                    status: status,
                                    keterangan: keterangan
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    $('#status-' + id).val(status);
                                    $('#keterangan-' + id).val(keterangan);
                                    alert('Data updated successfully!');
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    </div>
@stop
