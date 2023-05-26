@extends('layouts.main')
@section('title', 'Create Vacancy')

@section('content')
  <div class="container">
    <h1 class="my-5">Job Vacancy Form</h1>
    <form action="" method="post">
    @csrf
    @method('put')
      <div class="mb-3">
        <label for="title" class="form-label">Job Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Job Description</label>
        <textarea class="form-control" name="description" rows="5" required></textarea>
      </div>

      <!-- <div class="mb-3">
        <label for="Qualificaton" class="form-label">Job Qualificaton</label>
        <textarea class="form-control" id="Qualificaton" name="Qualificaton" rows="5" required></textarea>
      </div> -->
      <div class="mb-3">
        <label for="type" class="form-label">Job Type</label>
        <select class="form-select" id="type" name="type" required>
          <option value="Full-time">Full-time</option>
          <option value="Part-time">Part-time</option>
          <option value="Contract">Contract</option>
          <option value="Freelance">Freelance</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="salary" class="form-label">Job Salary</label>
        <input type="number" class="form-control" id="salary" name="salary" required>
      </div>
      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <select class="form-select" id="location" name="location" required>
          <option value="Jawa Barat">Jawa Barat</option>
          <option value="Jawa Tengah">Jawa Tengah</option>
          <option value="Jawa Timur">Jawa Timur</option>
          <option value="D.I. Yogyakarta">D.I. Yogyakarta</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
  
  <!-- Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
  <script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@stop
