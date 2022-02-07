<?php

use Illuminate\Support\Facades\Route;
use App\Warehouse;
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

// Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('adminicio');

Route::middleware('auth')->prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('warehouses', 'WarehousesController')->middleware('can:eAdmin');
    Route::resource('paquetes', 'PackageController')->middleware('can:eAdmin');
    Route::resource('clientes', 'ClientesController')->middleware('can:eAdmin');

    Route::resource('dados', 'MisDatosController')->middleware('can:eCli');
});
