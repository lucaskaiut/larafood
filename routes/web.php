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

    // Permission <> Profile
    Route::post('perfil/{id}/permissoes/desvincular', 'ACL\PermissionProfileController@detachPermissionsToProfile')->name('profiles.permissions.detach');
    Route::post('perfil/{id}/permissoes/vincular-permissoes', 'ACL\PermissionProfileController@attachPermissionsToProfile')->name('profiles.permissions.attach');
    Route::any('perfil/{id}/permissoes/vincular', 'ACL\PermissionProfileController@permissionsAvailableToProfile')->name('profiles.permissions.available');
    Route::get('perfil/{id}/permissoes/vincular', 'ACL\PermissionProfileController@permissionsAvailableToProfile')->name('profiles.permissions.available');

    // Permission

    Route::any('permissoes/filtrar', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissoes', 'ACL\PermissionController', [
        'names' => [
            'index' => 'permissions.index',
            'create' => 'permissions.create',
            'show' => 'permissions.show',
            'store' => 'permissions.store',
            'edit' => 'permissions.edit',
            'update' => 'permissions.update',
            'destroy' => 'permissions.destroy',
        ]
    ]);

    // Profile

    Route::post('perfis/filtrar', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('perfis', 'ACL\ProfileController', [
        'names' => [
            'index' => 'profiles.index',
            'create' => 'profiles.create',
            'show' => 'profiles.show',
            'store' => 'profiles.store',
            'edit' => 'profiles.edit',
            'update' => 'profiles.update',
            'destroy' => 'profiles.destroy',
        ]
    ]);

    // Details Plan
    Route::get('planos/{url}/detalhe/{id}/apagar', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::put('planos/{url}/detalhe/{id}/editar', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('planos/{url}/detalhe/{id}/editar', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('planos/{url}/detalhe/cadastrar', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('planos/{url}/detalhe/cadastrar', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('planos/{url}/detalhes', 'DetailPlanController@index')->name('details.plan.index');

    //Plans
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
