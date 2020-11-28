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
Route::prefix('admin')->namespace('Admin')->group(function(){

    Route::put('planos/editar/{url}', 'PlanController@update')->name('plans.update');
    Route::get('planos/editar/{url}', 'PlanController@edit')->name('plans.edit');
    Route::any('planos/filtrar', 'PlanController@search')->name('plans.search');
    Route::delete('planos/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('planos/cadastrar', 'PlanController@create')->name('plans.create');
    Route::post('planos/cadastrar', 'PlanController@store')->name('plans.store');
    Route::get('planos', 'PlanController@index')->name('plans.index');
    Route::get('planos/{url}', 'PlanController@show')->name('plans.show');

    Route::get('/', 'PlanController@index')->name('admin.home');
});


Route::get('/', function () {
    return view('welcome');
});
