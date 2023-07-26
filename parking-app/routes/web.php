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



Route::get('/', 'ClientController@index')->name('index');
Route::get('/show', 'ClientController@show')->name('show');
Route::get('/show/cars/client', 'CarController@showCarsClient')->name('check.client.cars');
Route::get('/client/create', 'ClientController@create')->name('create');
Route::post('/client', 'ClientController@store')->name('store');
Route::post('/add/car/{clientId}', 'CarController@addCarClient')->name('add.car.client');
Route::get('/client/{clientId}/edit', 'ClientController@edit')->name('edit');
Route::patch('/client/{clientId}', 'ClientController@clientUpdate')->name('client.update');
Route::patch('/client/{clientId}/cars', 'CarController@carsClientupdate')->name('cars.client.update');
Route::delete('/cars/{carsId}', 'CarController@carsDestroy')->name('cars.destroy');
Route::delete('/client/{clientId}', 'ClientController@clientDestroy')->name('client.destroy');
Route::post('/add/{carId}', 'CarController@addToParking')->name('add.to.parking');
Route::post('/remove/{carId}', 'CarController@removeFromParking')->name('remove.from.parking');

