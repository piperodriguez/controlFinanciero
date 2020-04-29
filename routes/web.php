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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('pagos', 'moduloAdmin\pagosctr');

Route::resource('ingresos', 'moduloAdmin\ingresosctr');


// Rutas asignadas para la creaci�n Del formulario d�namico

Route::post('/data/{nomprograma}/new', 'comunes\FormularioController@crearFormulario')->name('formulario.new');
Route::get('/formulario', 'comunes\FormularioController@index')->name('vista_formulario');
Route::post('/selectdata', 'comunes\FormularioController@getSelect')->name('consulta.select');
Route::post('/formulario', 'comunes\FormularioController@save')->name('formulario.save');


Route::post('/data/edit', 'comunes\FormularioController@edit')->name('formulario.edit');
Route::put('/data/{id}/update', 'comunes\FormularioController@update')->name('formulario.update');