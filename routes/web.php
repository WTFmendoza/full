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
    return view('auth/login');
});
Route :: resource('almacen/categoria','CategoriaController');
Route :: resource('almacen/articulo','ArticuloController');
Route :: resource('ventas/cliente','ClienteController');
Route :: resource('compras/proveedor','ProveedorController');
Route :: resource('compras/ingreso','IngresoController');
Route :: resource('ventas/venta','VentaController');
Route :: resource('seguridad/usuario','UsuarioController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('reportecategorias', 'CategoriaController@reporte');
Route::get('reportearticulos', 'ArticuloController@reporte');
Route::get('reporteclientes', 'ClienteController@reporte');
Route::get('reporteproveedores', 'ProveedorController@reporte');
Route::get('reporteventas', 'VentaController@reporte');
Route::get('reporteventa/{id}', 'VentaController@reportec');
Route::get('reporteingresos', 'IngresoController@reporte'); 
Route::get('reporteingreso/{id}', 'IngresoController@reportec'); 

Route::get('/{slug?}', 'HomeController@index');