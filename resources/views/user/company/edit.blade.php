@extends('user.layouts')
@section('title', 'Register Company')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Company</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/companies/{{ $company->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $company->name }}"
                                    placeholder="Enter name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-0">
                                <p for="image" class="form-label">Logo perusahaan</p>
                                <input type="file" name="image" id="image" accept="image/*"
                                    onchange="validateImageSize(this)" class="form-control">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-0">
                                <label for="nama_badan_usaha" class="form-label">Nama Badan Usaha</label>
                                <input type="nama_badan_usaha" name="nama_badan_usaha" id="nama_badan_usaha"
                                    class="form-control" required value="{{$company->nama_badan_usaha}}">
                                @error('nama_badan_usaha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-0">
                                <label for="no_telp" class="form-label">No. Telp</label>
                                <input type="text" name="no_telp" id="no_telp" class="form-control" required value="{{$company->no_telp}}">
                                @error('no_telp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-0">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" required  value="{{$company->alamat}}">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1 mt-0">
                                <label for="npwp" class="form-label">NPWP</label>
                                <input type="text" name="npwp" id="npwp" class="form-control" required value="{{$company->npwp}}">
                                @error('npwp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1 mt-0">
                                <label for="nama_pemilik" class="form-label">Nama Pemilik</label>
                                <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" required value="{{$company->nama_pemilik}}">
                                @error('nama_pemilik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
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
