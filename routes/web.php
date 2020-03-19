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
    return view('front-views.layouts.master');
});

Route::get('{any}', 'VeltrixController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/dashboard','ViewsControllers\DashboardController@showDashboard')->name('dashboard');

    Route::group(['prefix' => 'home-page'], function () {
        Route::get('slider','ActionControllers\SliderController@sliders')->name('homepage.slider');

        Route::get('customers','ActionControllers\ImageComponentController@customers')->name('homepage.customers');
    });

    Route::group(['prefix' => 'does'], function () {
        Route::post('upload-image','ActionControllers\SliderController@uploadSliderImage')->name('uploadSliderImage');
        Route::post('make-slider','ActionControllers\SliderController@makeSlider')->name('makeSlider');

        Route::post('upload-images','ActionControllers\ImageComponentController@uploadImages')->name('uploadImages');
        Route::post('remove-images', 'ActionControllers\ImageComponentController@deleteLogo')->name('removeCusLogo');
        Route::post('fetch-uploads', 'ActionControllers\ImageComponentController@getUploads')->name('getUploads');
    });
});
