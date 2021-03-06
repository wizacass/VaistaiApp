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
    return view('index');
});

Route::resource('/networks', 'PharmaceuticalNetworkController');
Route::resource('/warehouses', 'WarehouseController');
Route::resource('/pharmacies', 'PharmacyController');
Route::resource('/employees', 'EmployeeController');
Route::resource('/factories', 'FactoryController');
Route::resource('/positions', 'PositionController');

Route::get('/report', 'ReportController@index');
Route::post('/report', 'ReportController@show');
