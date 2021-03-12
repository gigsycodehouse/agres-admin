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
    Route::get('/', 'DashboardController@index');

    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', function () {
            dd('aa');
        });
    });
    Route::get('get/{category_id}/spesification', 'Controller@getSpesification')->name('get.subcategory');
    Route::get('get/{category_id}/sub_category', 'Controller@getSubCategory')->name('get.subcategory');
    Route::get('get/{province_id}/cities', 'Controller@getCities')->name('get.city');
    Route::get('get/{city_id}/districts', 'Controller@getDistricts')->name('get.district');

    Route::resource('user', 'UserController');
    Route::post('user/{user_id}/updaterole', 'UserController@updateRole')->name('user.updaterole');
    Route::post('user/{user_id}/updatestatus', 'UserController@updateStatus')->name('user.updatestatus');
    Route::resource('member', 'MemberController');
    Route::get('member/unverified/get', 'MemberController@unverifiedAccount')->name('member.unverified');
    Route::post('member/unverified/{member_id}/verify', 'MemberController@verifyAccount')->name('member.verify');

    Route::get('member_address/', 'MemberAddressController@index')->name('member_address.index');
    Route::get('member_address/{member_id}/show', 'MemberAddressController@show')->name('member_address.show');
    Route::get('member_address/{member_id}/create', 'MemberAddressController@create')->name('member_address.create');
    Route::post('member_address/{member_id}/store', 'MemberAddressController@store')->name('member_address.store');
    Route::get('member_address/{member_id}/edit/{address_id}', 'MemberAddressController@edit')->name('member_address.edit');
    Route::put('member_address/{member_id}/update/{address_id}', 'MemberAddressController@update')->name('member_address.update');
    Route::delete('member_address/{member_id}/destroy/{address_id}', 'MemberAddressController@destroy')->name('member_address.destroy');

    Route::resource('homepage_banner', 'HomeBannerController');
    Route::resource('catalog_banner', 'CatalogBannerController');
    Route::resource('homepage_bottom_menu', 'HomeBottomMenuController');
    Route::resource('homepage_top_menu', 'HomeTopMenuController');
    Route::resource('homepage_promo_banner', 'HomePromoBannerController');

    Route::resource('blast_email', 'BlastEmailController');

    Route::resource('category', 'CategoryController');
    Route::resource('sub_category', 'SubCategoryController');

    Route::resource('item', 'ItemController');
    Route::get('item/{item_id}/review', 'ItemController@review')->name('item.review');

    Route::get('varian/{item_id}/varian', 'ItemVarianController@index')->name('variant.index');
    Route::get('varian/{item_id}/create', 'ItemVarianController@create')->name('variant.create');
    Route::post('varian/{item_id}/store', 'ItemVarianController@store')->name('variant.store');
    // Route::post('varian/{varaint_id}/update_stock', 'ItemVarianController@updateStock')->name('item.update_stock');
    Route::get('varian/{item_id}/edit/{variant_id}', 'ItemVarianController@edit')->name('variant.edit');
    Route::put('varian/{item_id}/update/{variant_id}', 'ItemVarianController@update')->name('variant.update');
    Route::delete('varian/{item_id}/destroy/{variant_id}', 'ItemVarianController@destroy')->name('variant.destroy');

    Route::resource('item_hot', 'ItemHotController');
    Route::resource('item_select', 'ItemSelectController');
    Route::resource('item_image', 'itemImageController');


    // dropzone tidak berguna
    Route::post('item/get/{item_id}/image', 'ItemController@getImage')->name('item.upload_image');
    Route::get('item/get/{item_id}/image', 'ItemController@getImage')->name('item.get_upload_image');
});
