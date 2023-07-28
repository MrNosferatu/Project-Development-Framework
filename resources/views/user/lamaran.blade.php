@extends('layouts.main')
@section('title', 'View Vacancy')

@section('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div style="width:70vw" class="mx-auto">
        <br>
        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Perusahaan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @foreach ($lamaran as $application)
                        <tr data-id="{{ $application->id }}">
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $application->title }}</td>
                            <td>{{ $application->nama_badan_usaha }}</td>
                            <td>{{ $application->status }}</td>
                            <td>{{ $application->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <script>
                    $(document).ready(function() {
                        $('.save-btn').on('click', function() {
                            var tr = $(this).closest('tr');
                            var id = tr.data('id');
                            var status = tr.find('.status').val();
                            var keterangan = tr.find('.keterangan').val();

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
                                    tr.find('.status').val(status);
                                    tr.find('.keterangan').val(keterangan);
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
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script> -->
    </div>
@stop
