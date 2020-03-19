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

Route::get('/front', function () {
    return view('front-views.layouts.master');
})->name('myRoute')->defaults('Menu','SMS App');


//Route::get('{any}', 'VeltrixController@index');

Route::group(['prefix' => 'admin','Title' => 'Admin'], function () {

    Route::get('/','SiteController@setup')->name('site.setup')->defaults('Menu','Setup Page');;
    Route::get('/dashboard','ViewsControllers\DashboardController@showDashboard')->name('dashboard')->defaults('Menu','Dashboard');;

    Route::group(['prefix' => 'app','Title' => 'Customers'], function () {
        Route::get('slider','ActionControllers\SliderController@sliders')->name('homepage.slider')->defaults('Menu','Slider Page');;
        Route::get('customers','ActionControllers\ImageComponentController@customers')->name('homepage.customers')->defaults('Menu','Customers Page');;
    });

    Route::group(['prefix' => 'does'], function () {
        Route::post('upload-image','ActionControllers\SliderController@uploadSliderImage')->name('uploadSliderImage');
        Route::post('make-slider','ActionControllers\SliderController@makeSlider')->name('makeSlider');

        Route::post('upload-images','ActionControllers\ImageComponentController@uploadImages')->name('uploadImages');
        Route::post('remove-images', 'ActionControllers\ImageComponentController@deleteLogo')->name('removeCusLogo');
        Route::post('fetch-uploads', 'ActionControllers\ImageComponentController@getUploads')->name('getUploads');
    });
});
