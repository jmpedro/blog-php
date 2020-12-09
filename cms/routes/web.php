<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('plantilla');
});

/* Configuramos las rutas de las diferentes páginas */
Route::view('/', 'pages.blog');
Route::view('/administradores', 'pages.administradores');
Route::view('/anuncios', 'pages.anuncios');
Route::view('/articulos', 'pages.articulos');
Route::view('/banner', 'pages.banner');
Route::view('/categorias', 'pages.categorias');
Route::view('/opiniones', 'pages.opiniones');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
