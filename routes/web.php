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

Route::get('/', [App\Http\Controllers\VacancyController::class, 'index']);
Route::get('/vacancy/create', function () {
    return view('Vacancy/input');
});
Route::put('/vacancy/create', [App\Http\Controllers\VacancyController::class, 'store']);
Route::get('/vacancy/{id}', [App\Http\Controllers\VacancyController::class, 'view']);
Route::get('/vacancy/edit/{id}', [App\Http\Controllers\VacancyController::class, 'edit']);
Route::patch('/vacancy/edit/{id}', [App\Http\Controllers\VacancyController::class, 'update']);
Route::get('/vacancy/delete/{id}', [App\Http\Controllers\VacancyController::class, 'delete']);
// Route::post('/search', [App\Http\Controllers\VacancyController::class, 'search']);

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