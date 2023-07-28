@extends('layouts.main')
@section('title', 'Register Company')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-header bg-white text-center">
                <h2 class="card-title">Register Company</h2>
            </div>
            <div class="card-body pt-5">
                <form method="POST" action="/companies" class="row g-3 mx-auto" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{session('user')->id}}" hidden locked>
                    <div class="mb-1 mt-0">
                        <label for="name" class="form-label">Company Name</label>
                        <input type="text" name="name" id="name" class="form-control" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <p for="image" class="form-label">Logo perusahaan</p>
                        <input type="file" name="image" id="image" accept="image/*"
                            onchange="validateImageSize(this)" class="form-control" required>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="nama_badan_usaha" class="form-label">Nama Badan Usaha</label>
                        <input type="nama_badan_usaha" name="nama_badan_usaha" id="nama_badan_usaha" class="form-control" required>
                        @error('nama_badan_usaha')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 mt-0">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" name="npwp" id="npwp" class="form-control" required>
                        @error('npwp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" required>
                        @error('nama_pemilik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    function validateImageSize(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.onload = function() {
                    if (img.width != 400 || img.height != 400) {
                        input.setCustomValidity('Image must be 400x400.');
                    } else {
                        input.setCustomValidity('');
                    }
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
