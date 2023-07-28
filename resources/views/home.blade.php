@extends('layouts.main')
@section('title', 'GradJobs')

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="background-color:grey">
        <div class="p-2 ">
            <div class="row d-flex flex-row-reverse">
                <div class="col-12 col-md-9">
                    <div class="rounded-3 text-dark">
                        <div class="container-fluid py-5">
                            <h1 class="display-5 fw-bold">GradJobs</h1>
                            <p class="col-md-8 fs-4">Cari lowongan pekerjaan yang cocok untuk anda</p>
                            <a href="/vacancy" class="btn btn-light text-black btn-lg" type="button">Lowongan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron">
        <form id="search-form">
            @csrf
            <div class="text-center">
                <h2>Cari Lowongan Kerja</h2>
            </div>
            <br>
            <div class="input-group mb-3 mx-auto">
                <input type="text" class="form-control" aria-label="Text input with dropdown button" name="query">
                <select class="form-select" aria-label="Default select example" name="type">
                    <option value="any" selected>Jenis</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Contract">Contract</option>
                    <option value="Freelance">Freelance</option>
                </select>
                <button class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <div class="row"></div>
    <script>
        const searchForm = document.getElementById('search-form');
        const searchResults = document.querySelector('.row');

        searchForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const formData = new FormData(searchForm);
            const xhr = new XMLHttpRequest();

            xhr.open('POST', '/search');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.addEventListener('load', () => {
                const response = JSON.parse(xhr.responseText);
                searchResults.innerHTML = '';

                response.forEach((vacancy) => {
                    const card = document.createElement('div');
                    card.classList.add('col-6', 'p-2');
                    card.innerHTML = `
        <div class="card">
          <h5 class="card-header">${vacancy.title}</h5>
          <div class="card-body">
            <p class="card-text">${vacancy.type}</p>
            <p class="card-text">Rp. ${vacancy.salary}</p>
          </div>
          <div class="card-footer">
            <p class="card-text">Lokasi : ${vacancy.location}</p>
          </div>
          <a href="vacancy/${vacancy.id}" class="stretched-link"></a>
        </div>
      `;
                    searchResults.appendChild(card);
                });
            });

            xhr.send(formData);
        });
    </script>
@stop
