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
    return view('welcome');
});

Route::get('/home','HomeController@home')->name('home');
//Route para adicionar
/*
Route::get('/adicionar', 'HomeController@adicionar');
Route::post('/adicionar','HomeController@adicionar');
Route::post('/adicionar.blade.php', 'HomeController@adicionar');
Route::get('/adicionar.blade.php', 'HomeController@adicionar');
*/
//Route para get e post
Route::match(['get', 'post'],'adicionar','HomeController@adicionar')->name('adicionar');

//Route para deletar
Route::get('/delete/{id}', 'HomeController@deletar');

//Route para Alterar
Route::match(['get', 'post'],'/alterar/{id}','HomeController@alterar');


Auth::routes();

Route::get('/index', 'HomeController@index')->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Rotas da Categoria
Route::match(['get', 'post'],'/categoria', 'CategoriaController@adicionar')->name('categoria')->middleware('auth');

Auth::routes();

Route::get('pdf', 'HomeController@gerarPDF')->name('pdf')->name('pdf');

Route::get('grafico', 'HomeController@graficoGerar')->name('grafico');
