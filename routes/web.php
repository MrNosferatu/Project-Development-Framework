<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::post('/search', [App\Http\Controllers\VacancyController::class, 'search'])->name('search');

    Route::get('/article', [App\Http\Controllers\ArticleController::class, 'index']);
    Route::get('/article/write', function () {
        return view('Article/input');
    });
    Route::put('/article/write', [App\Http\Controllers\ArticleController::class, 'store']);
    Route::get('/article/{id}', [App\Http\Controllers\ArticleController::class, 'view']);
    Route::get('/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'edit']);
    Route::patch('/article/edit/{id}', [App\Http\Controllers\ArticleController::class, 'update']);
    Route::get('/article/delete/{id}', [App\Http\Controllers\ArticleController::class, 'delete']);
    route::get('/login', [App\Http\Controllers\UserController::class, 'index']);
    route::get('/register', [App\Http\Controllers\UserController::class, 'create']);
    // route::put('/user/register', [App\Http\Controllers\UserController::class, 'store']);
    route::post('/user/login', [App\Http\Controllers\UserController::class, 'login']);
    route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

    Route::get('/vacancy', [App\Http\Controllers\VacancyController::class, 'index']);
    Route::get('/companies/vacancy', [App\Http\Controllers\VacancyController::class, 'companies_vacancy']);
    Route::get('/companies/vacancy/{id}', [App\Http\Controllers\VacancyController::class, 'companies_vacancy_view']);
    Route::get('/vacancy/create', [App\Http\Controllers\VacancyController::class, 'create']);

    Route::put('/vacancy/create', [App\Http\Controllers\VacancyController::class, 'store']);
    Route::get('/vacancy/{id}', [App\Http\Controllers\VacancyController::class, 'view']);
    Route::post('/vacancy/{id}/apply', [App\Http\Controllers\VacancyController::class, 'apply']);
    Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile']);
    Route::get('/profile/edit', [App\Http\Controllers\UserController::class, 'profile_edit']);
    Route::post('/profile/edit', [App\Http\Controllers\UserController::class, 'profile_update']);
    Route::get('/vacancy/edit/{id}', [App\Http\Controllers\VacancyController::class, 'edit']);
    Route::patch('/vacancy/edit/{id}', [App\Http\Controllers\VacancyController::class, 'update']);
    Route::get('/vacancy/delete/{id}', [App\Http\Controllers\VacancyController::class, 'delete']);
    Route::put('/lamaran/edit/{id}', [App\Http\Controllers\VacancyController::class, 'updateApplication']);
    Route::get('/user/lamaran', [App\Http\Controllers\VacancyController::class, 'user_lamaran']);

    Route::resource('companies', App\Http\Controllers\CompanyController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::get('/download-cv/{filename}', [App\Http\Controllers\VacancyController::class, 'downloadCV'])->name('download.cv');

});