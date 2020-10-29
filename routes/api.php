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

Route::get('properties', 'PropertyController@index');

Route::name('propery.')->prefix('property')->group(function () {
    Route::name('show')->get('{id}', 'PropertyController@show');
    Route::name('store')->post('/store', 'PropertyController@store');
    Route::name('edit')->get('/edit/{id}', 'PropertyController@edit');
    Route::name('update')->put('/update/{id}', 'PropertyController@update');
    Route::name('destroy')->delete('/delete/{id}', 'PropertyController@destroy');
});



Route::get('contracts', 'ContractController@index');

Route::name('contract.')->prefix('contract')->group(function () {
    Route::name('show')->get('{id}', 'ContractController@show');
    Route::name('store')->post('/store', 'ContractController@store');
    Route::name('edit')->get('/edit/{id}', 'ContractController@edit');
    Route::name('update')->put('/update/{id}', 'ContractController@update');
    Route::name('destroy')->delete('/delete/{id}', 'ContractController@destroy');
});
