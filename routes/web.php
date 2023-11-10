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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::post('/kamar/post', 'App\Http\Controllers\MasterPasienController@store')->name('pasien.store');
Route::get('/input', 'App\Http\Controllers\MasterPasienController@create')->name('pasien.create');
Route::post('/input/edit/{id}', 'App\Http\Controllers\MasterPasienController@editvelocity')->name('velocity.edit');
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    //Route User
    Route::get('/user','App\Http\Controllers\UserController@user')->name('user.index');
    Route::post('/user-post','App\Http\Controllers\UserController@store')->name('user.store');
    Route::post('/user-post/{id}','App\Http\Controllers\UserController@update')->name('user.update');
    Route::delete('/user-hapus/{id}','App\Http\Controllers\UserController@destroy')->name('user.destroy');

    // Kamar
    Route::get('/kamar', 'App\Http\Controllers\MasterPasienController@index')->name('pasien.index');
    Route::post('/kamar/edit/{id}', 'App\Http\Controllers\MasterPasienController@edit')->name('kamar.edit');
    Route::delete('/kamar/delete/{id}','App\Http\Controllers\MasterPasienController@destroy')->name('kamar.destroy');
    Route::post('/kamar/tanggal','App\Http\Controllers\MasterPasienController@filter')->name('pasien.filter');
    Route::get('/kamar/detail/{id}', 'App\Http\Controllers\MasterPasienController@detail')->name('kamar.detail');
    Route::post('/kamar/detail/edit/{id}', 'App\Http\Controllers\MasterPasienController@update')->name('kamar_detail.edit');

});

