<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar sticky-top bg-primary-subtle text-emphasis-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">GradJobs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item mx-3">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="/article">Article</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Devs
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/vacancy/create">Post Vacancy</a></li>
                            <li><a class="dropdown-item" href="/article/write">Post Article</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container p-5">
        @yield('content')
    </div>

    <section class="">
        <footer
            class="bg-secondary text-black text-center mt-auto text-md-start bg-primary-subtle text-emphasis-primary">
            <div class="container p-4">
                <div class="row">
                    <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                        <h5 class="text-uppercase">GradJobs</h5>
                        <p>
                            Jl. Ring Road Utara, Ngringin, Condongcatur, Kec. Depok, Kabupaten Sleman, Daerah
                            Istimewa Yogyakarta 55281
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Bantuan</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#" class="text-black text-decoration-none">Help Cennter</a>
                            </li>
                            <li>
                                <a href="#" class="text-black text-decoration-none">Hubungi Kami</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase mb-0">Informasi Lainnya</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#" class="text-black text-decoration-none">Link 1</a>
                            </li>
                            <li>
                                <a href="#" class="text-black text-decoration-none">Link 2</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2023 Copyright:
                <a class="text-black text-decoration-none" href="">Jobs</a>
            </div>
        </footer>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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

</body>

</html>
