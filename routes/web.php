<?php


/*
* Routes for website admiin
*/
Route::get('/admin/dashboard', 'ViewsControllers\DashboardController@showDashboard')->name('admin.dashboard')->defaults('Menu','Dashboard');
Route::get('/admin/customers', 'UserController@showUsers')->name('admin.customers')->defaults('Menu','Customers');


//Route::get('{any}', 'VeltrixController@index');

Route::group(['prefix' => 'admin','Title' => 'Admin'], function () {

    Route::get('/','SiteController@setup')->name('site.setup')->defaults('Menu','Setup Page');
    Route::get('/dashboard','ViewsControllers\DashboardController@showDashboard')->name('dashboard')->defaults('Menu','Dashboard');;

    Route::group(['prefix' => 'app','Title' => 'Customers'], function () {
        Route::get('slider','ActionControllers\SliderController@sliders')->name('homepage.slider')->defaults('Menu','Slider Page');
        Route::get('customers','ActionControllers\ImageComponentController@customers')->name('homepage.customers')->defaults('Menu','Customers Page');;
    });

    Route::group(['prefix' => 'users','Title' => 'Users'], function () {
        Route::get('all-users','UserController@showUsers')->name('user.create')->defaults('Menu','Create User');
    });

    Route::group(['prefix' => 'does'], function () {
        Route::post('upload-image','ActionControllers\SliderController@uploadSliderImage')->name('uploadSliderImage');
        Route::post('create-user','UserController@createUser')->name('createUser');

        Route::post('upload-images','ActionControllers\ImageComponentController@uploadImages')->name('uploadImages');
        Route::post('remove-images', 'ActionControllers\ImageComponentController@deleteLogo')->name('removeCusLogo');
        Route::post('fetch-uploads', 'ActionControllers\ImageComponentController@getUploads')->name('getUploads');
    });
});
