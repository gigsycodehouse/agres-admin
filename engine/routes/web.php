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



Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::resource('user', 'UserController');
    Route::resource('member', 'MemberController');
    Route::get('member_address/', 'MemberAddressController@index')->name('member_address.index');
    Route::get('member_address/{member_id}/show', 'MemberAddressController@show')->name('member_address.show');
    Route::get('member_address/{member_id}/create', 'MemberAddressController@create')->name('member_address.create');
    Route::post('member_address/{member_id}/store', 'MemberAddressController@store')->name('member_address.store');
    Route::get('member_address/{member_id}/edit', 'MemberAddressController@edit')->name('member_address.edit');
    Route::post('member_address/{member_id}/update', 'MemberAddressController@update')->name('member_address.update');
    Route::post('member_address/{member_id}/destroy', 'MemberAddressController@destroy')->name('member_address.destroy');

    Route::resource('homepage_banner', 'HomeBannerController');
});
