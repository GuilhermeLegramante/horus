<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', 'AuthController@loginView')->name('loginView');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/sair', 'AuthController@logout')->name('logout');

Route::get('/find-products', 'MainController@findProductsCode')->name('find-product');

Route::get('/cosmos', 'MainController@findProductFromCosmosApi')->name('cosmos');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'MainController@dashboard')->name('dashboard');

    Route::prefix('/usuario')->group(function () {
        Route::get('/', 'UserController@table')->name('user.table');
        Route::get('/inclusao', 'UserController@form')->name('user.create');
        Route::get('/{id}', 'UserController@form')->name('user.edit');
    });

    Route::prefix('/unidade-de-medida')->group(function () {
        Route::get('/', 'MeasurementUnitController@table')->name('measurementUnit.table');
    });

    Route::prefix('/produto')->group(function () {
        Route::get('/', 'ProductController@table')->name('product.table');
    });

    Route::prefix('/centro-de-custos')->group(function () {
        Route::get('/', 'CostcenterController@table')->name('costcenter.table');
    });

    Route::prefix('/entrada-de-produto')->group(function () {
        Route::get('/', 'EntryController@table')->name('entry.table');
    });

    Route::prefix('/saldo-do-estoque')->group(function () {
        Route::get('/', 'FakebalanceController@table')->name('fakebalance.table');
    });
});
