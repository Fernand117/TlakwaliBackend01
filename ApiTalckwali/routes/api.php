<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/**NOTA
 * LOS METODOS PARA GUARDAR Y EDITAR INFORMACIÓN TIENEN QUE SE METODOS POST
 */
Route::get('categorias', 'CategoriasController@index');
Route::get('categorias/{id}', 'CategoriasController@edit');
Route::post('categorias/nueva', 'CategoriasController@store');
Route::post('categorias/edit/{id}', 'CategoriasController@update');
Route::delete('categorias/eliminar/{id}', 'CategoriasController@destroy');

Route::get('categorias/productos/{id}', 'CategoriasController@ViewProductsCategories');

Route::get('mesas', 'MesasController@index');
Route::get('mesas/{id}', 'MesasController@edit');
Route::post('mesas/nueva', 'MesasController@store');
Route::post('mesas/edit/{id}', 'MesasController@update');
Route::delete('mesas/eliminar/{id}', 'MesasController@destroy');


Route::get('productos', 'ProductosController@index');
Route::get('productos/{id}', 'ProductosController@edit');
Route::post('productos/nuevo', 'ProductosController@store');
Route::post('productos/edit/{id}', 'ProductosController@update');
Route::delete('productos/eliminar/{id}', 'ProductosController@destroy');