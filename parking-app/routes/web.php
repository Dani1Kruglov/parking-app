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



Route::get('/', 'IndexController@index')->name('index');
Route::get('/show', 'IndexController@show')->name('show');
Route::get('/show/cars/client', 'IndexController@showCarsClient')->name('check.client.cars');
Route::get('/client/create', 'CreateController@create')->name('create');
Route::post('/client', 'CreateController@store')->name('store');
Route::get('/client/{clientId}/edit', 'EditController@edit')->name('edit');
Route::post('/add/car/{clientId}', 'CreateController@addCarClient')->name('add.car.client');
Route::patch('/client/{clientId}', 'EditController@clientUpdate')->name('client.update');
Route::patch('/client/{clientId}/cars', 'EditController@carsClientupdate')->name('cars.client.update');
Route::delete('/cars/{carsId}', 'DeleteController@carsDestroy')->name('cars.destroy');
Route::delete('/client/{clientId}', 'DeleteController@clientDestroy')->name('client.destroy');
Route::post('/add/{carId}', 'ParkingStatusController@addToParking')->name('add.to.parking');
Route::post('/remove/{carId}', 'ParkingStatusController@removeFromParking')->name('remove.from.parking');

