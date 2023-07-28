@extends('user.layouts')
@section('title', 'Register')
@section('content')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-auto mt-5" style="max-width: 500px;">
            <div class="card-header bg-white text-center">
                <h2 class="card-title">Register</h2>
            </div>
            <div class="card-body pt-5">
                <form method="POST" action="/user" class="row g-3 mx-auto" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="mb-1 mt-0">
                        <label for="user_type" class="form-label">User Type</label>
                        <select name="user_type" id="user_type" class="form-control" required>
                            <option value="">-- Select User Type --</option>
                            <option value="user">User</option>
                            <option value="perusahaan">perusahaan</option>
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- <div class="mb-1 mt-0">
                        <p for="photo_profile" class="form-label">Photo Profile</p>
                        <input type="file" name="photo_profile" id="photo_profile" accept="image/*"
                            onchange="validateImageSize(this)" class="form-control" required>
                        @error('photo_profile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> -->
                    <div class="mb-1 mt-0">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-1 mt-0">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                            class="form-control" required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}"
                            class="form-control" required>
                        @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                            value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-1 mt-0" id="cvBlock" style="display: none;">
                        <p for="cv" class="form-label">CV</p>
                        <input type="file" name="cv" id="cv" class="form-control">
                        @error('cv')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success">Register</button>
                        <a class="btn btn-light" href="/login">Login</a>
                    </div>
                </form>
                <script>
    var cvInput = document.getElementById('cvBlock');
    var userTypeSelect = document.getElementById('user_type');

    userTypeSelect.addEventListener('change', function() {
        if (userTypeSelect.value === 'user') {
            cvInput.style.display = 'block';
        } else {
            cvInput.style.display = 'none';
        }
    });
</script>
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