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

Route::put('admin/planos/editar/{url}', 'Admin\PlanController@update')->name('plans.update');
Route::get('admin/planos/editar/{url}', 'Admin\PlanController@edit')->name('plans.edit');
Route::any('admin/planos/filtrar', 'Admin\PlanController@search')->name('plans.search');
Route::delete('admin/planos/{url}', 'Admin\PlanController@destroy')->name('plans.destroy');
Route::get('admin/planos/cadastrar', 'Admin\PlanController@create')->name('plans.create');
Route::post('admin/planos/cadastrar', 'Admin\PlanController@store')->name('plans.store');
Route::get('admin/planos', 'Admin\PlanController@index')->name('plans.index');
Route::get('admin/planos/{url}', 'Admin\PlanController@show')->name('plans.show');

Route::get('admin', 'Admin\PlanController@index')->name('admin.home');

Route::get('/', function () {
    return view('welcome');
});
