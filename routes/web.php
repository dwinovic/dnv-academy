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

// Login
Route::get('/login', 'AuthController@login')->name('login');

Route::post('/postlogin', 'AuthController@postlogin');

// Route Group => middleware auth
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('/dashboard');
    }); 
    Route::get('/dashboard', 'DashboardController@index');
    
    Route::get('/siswa', 'SiswaController@index');
    
    // Menghandle dari inputan data
    Route::post('/siswa/create', 'SiswaController@create');
    
    // Edit data
    Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    
    //Update data
    Route::post('/siswa/{id}/update', 'SiswaController@update'); 
    
    // Delete data
    Route::get('/siswa/{id}/delete', 'SiswaController@delete');
});

//Logout
Route::get('/logout', 'AuthController@logout');

