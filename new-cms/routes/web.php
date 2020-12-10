<?php

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
// Route::view('/', 'pages.blog');
// Route::view('/administradores', 'pages.administradores');
// Route::view('/anuncios', 'pages.anuncios');
// Route::view('/articulos', 'pages.articulos');
// Route::view('/banner', 'pages.banner');
// Route::view('/categorias', 'pages.categorias');
// Route::view('/opiniones', 'pages.opiniones');

/* Damos permiso para que los controladores ejecuten el método get a la base de datos */

/* El primer parámetro es la ruta donde va a hacer el get, y el segundo es el controlador junto a su método que se encargan
   de hacer la llamada a get */
// Route::get('/', 'BlogController@getBlog');
// Route::get('/administradores', 'AdministradorController@getUsers');
// Route::get('/anuncios', 'AnuncioController@getAnuncios');
// Route::get('/articulos', 'ArticuloController@getArticulo');
// Route::get('/banner', 'BannerController@getBanner');
// Route::get('/categorias', 'CategoriaController@getCategoria');
// Route::get('/opiniones', 'OpinionController@getOpinion');

/* Para evitar tener que estar llamando manualmente a cada controlador y cada vista, podemos usar el metodo resource(), que nos 
   devuelve todos los métodos posibles */
   // php artisan route:list para ver el nombre que debemos ponerle a nuestros métodos 

Route::resource('/', 'BlogController');
Route::resource('/blog', 'BlogController');
Route::resource('/administradores', 'AdministradorController');
Route::resource('/anuncios', 'AnuncioController');
Route::resource('/articulos', 'ArticuloController');
Route::resource('/banner', 'BannerController');
Route::resource('/categorias', 'CategoriaController');
Route::resource('/opiniones', 'OpinionController');

