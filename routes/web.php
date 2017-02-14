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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('home','HomeController@index')->name('home');

    Route::resource('/export', 'ExportController', ['except' => [
        'show'
    ]]);

    Route::resource('/exported_product', 'ExportedProductController', ['except' => [
        'create', 'show', 'edit'
    ]]);

    Route::group(
        ['middleware' => 'can:access-lists',
        'prefix' => 'lists'],
        function () {
            Route::get('/', function() { return view('lists/lists');})->name('lists-index');
            Route::resource('/transport', 'TransportController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/purpose', 'PurposeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/product_type', 'ProductTypeController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/storage', 'StorageController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/region', 'RegionController', ['except' => [
                'create', 'show'
            ]]);
            Route::resource('/district', 'DistrictController', ['except' => [
                'create', 'show', 'edit'
            ]]);
            Route::resource('/organization', 'OrganizationController', ['except' => [
                'create', 'show', 'edit'
            ]]);
        }
    );
});
