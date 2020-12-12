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
Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function(){

    // Role <> User
    Route::post('usuario/{id}/cargos/desvincular', 'ACL\RoleUserController@detachRolesToUser')->name('users.roles.detach');
    Route::post('usuario/{id}/cargos/vincular-cargos', 'ACL\RoleUserController@attachRolesToUser')->name('users.roles.attach');
    Route::any('usuario/{id}/cargos/vincular', 'ACL\RoleUserController@rolesAvailableToUser')->name('users.roles.available');
    Route::get('usuario/{id}/cargos/vincular', 'ACL\RoleUserController@rolesAvailableToUser')->name('users.roles.available');

    // Permission <> Role
    Route::post('cargo/{id}/permissoes/desvincular', 'ACL\PermissionRoleController@detachPermissionsToRole')->name('roles.permissions.detach');
    Route::post('cargo/{id}/permissoes/vincular-permissoes', 'ACL\PermissionRoleController@attachPermissionsToRole')->name('roles.permissions.attach');
    Route::any('cargo/{id}/permissoes/vincular', 'ACL\PermissionRoleController@permissionsAvailableToRole')->name('roles.permissions.available');
    Route::get('cargo/{id}/permissoes/vincular', 'ACL\PermissionRoleController@permissionsAvailableToRole')->name('roles.permissions.available');

    // Role
    Route::post('cargos/filtrar', 'ACL\RoleController@search')->name('roles.search');
    Route::resource('cargos', 'ACL\RoleController', [
        'names' => [
            'index' => 'roles.index',
            'create' => 'roles.create',
            'show' => 'roles.show',
            'store' => 'roles.store',
            'edit' => 'roles.edit',
            'update' => 'roles.update',
            'destroy' => 'roles.destroy',
        ]
    ]);

    // Tenants
    Route::any('empresas/procurar', 'TenantController@search')->name('tenants.search');
    Route::resource('empresas', 'TenantController', [
        'names' => [
            'index' => 'tenants.index',
            'create' => 'tenants.create',
            'show' => 'tenants.show',
            'store' => 'tenants.store',
            'edit' => 'tenants.edit',
            'update' => 'tenants.update',
            'destroy' => 'tenants.destroy',
        ]
    ]);

    // Tables
    Route::get('mesas/qrcode/{id}', 'TableController@qrcode')->name('tables.qrcode');

    Route::any('mesas/procurar', 'TableController@search')->name('tables.search');
    Route::resource('mesas', 'TableController', [
        'names' => [
            'index' => 'tables.index',
            'create' => 'tables.create',
            'show' => 'tables.show',
            'store' => 'tables.store',
            'edit' => 'tables.edit',
            'update' => 'tables.update',
            'destroy' => 'tables.destroy',
        ]
    ]);

    // Category <> Product
    Route::post('produto/{id}/categorias/desvincular', 'CategoryProductController@detachCategoriesToProduct')->name('products.categories.detach');
    Route::post('produto/{id}/categorias/vincular-categorias', 'CategoryProductController@attachCategoriesToProduct')->name('products.categories.attach');
    Route::any('produto/{id}/categorias/vincular', 'CategoryProductController@categoriesAvailableToProduct')->name('products.categories.available');
    Route::get('produto/{id}/categorias/vincular', 'CategoryProductController@categoriesAvailableToProduct')->name('products.categories.available');

    Route::any('produtos/procurar', 'ProductController@search')->name('products.search');
    Route::resource('produtos', 'ProductController', [
        'names' => [
            'index' => 'products.index',
            'create' => 'products.create',
            'show' => 'products.show',
            'store' => 'products.store',
            'edit' => 'products.edit',
            'update' => 'products.update',
            'destroy' => 'products.destroy',
        ]
    ]);

    Route::any('categorias/procurar', 'CategoryController@search')->name('categories.search');
    Route::resource('categorias', 'CategoryController', [
        'names' => [
            'index' => 'categories.index',
            'create' => 'categories.create',
            'show' => 'categories.show',
            'store' => 'categories.store',
            'edit' => 'categories.edit',
            'update' => 'categories.update',
            'destroy' => 'categories.destroy',
        ]
    ]);

    Route::delete('usuarios/{id}/apagar', 'UserController@destroy')->name('users.destroy');
    Route::put('usuarios/editar/{id}', 'UserController@update')->name('users.update');
    Route::get('usuarios/editar/{id}', 'UserController@edit')->name('users.edit');
    Route::get('usuarios/detalhes/{id}', 'UserController@show')->name('users.show');
    Route::post('usuarios/cadastrar', 'UserController@store')->name('users.store');
    Route::get('usuarios/cadastrar', 'UserController@create')->name('users.create');
    Route::get('usuarios', 'UserController@index')->name('users.index');

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

    // Plans <> Profile
    Route::post('planos/{url}/perfis/desvincular', 'PlanProfileController@detachProfile')->name('plans.profiles.detach');
    Route::post('planos/{url}/perfis/vincular-perfis', 'PlanProfileController@attachProfile')->name('plans.profiles.attach');
    Route::any('planos/{url}/perfis/vincular', 'PlanProfileController@availableProfiles')->name('plans.profiles.available');
    Route::get('planos/{url}/perfis', 'PlanProfileController@profiles')->name('plans.profiles');

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

    Route::get('/', 'DashboardController@index')->name('admin.home');
});

Route::namespace('Site')->group(function(){
    Route::get('/plano/{url}', 'SubscriptionController@plan')->name('plan.subscription');
    Route::get('/', 'SiteController@index')->name('site.home');
});

/*
 * Auth routes
 */

Auth::routes();
