@extends('layouts.main')
@section('title', 'GradJobs')

@section('content')
<form class="p-4 p-md-5 border rounded-3 bg-light">
  <h2 class="mb-4">Login</h2>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
@stop