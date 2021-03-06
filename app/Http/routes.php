<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

#Redirect if logged in
Route::group(['middleware'=>['guest']],function() {
# Authentication Route
    Route::auth();
});

# Front End Views Routes
Route::get('/','HomeController@root');
Route::get('aboutUs',function () {
    return view('frontend.about');
});
Route::get('Events','HomeController@events');
Route::get('Blogs','HomeController@blogs');
Route::get('Blog/{id}','BlogController@show');
Route::get('Gallery/{id}',['uses'=>'HomeController@gallery']);
Route::get('contactUs','AboutController@create');
Route::post('contactUs','AboutController@store');
Route::get('Register','RegisterController@create');
Route::post('Register','RegisterController@store');

Route::get('Services',function(){
    return view('frontend.service');
});
Route::get('Packages',function(){
    return view('frontend.packages');
});
Route::get('Register',function(){
    return view('frontend.register');
});

# Routes that only admin can access
Route::group(['middleware'=>['auth']],function(){
    # Dashboard
    Route::get('/home', 'HomeController@index');

    # Event gallery Routes
    Route::get('event/new','EventGalleryController@create');
    Route::post('event/new','EventGalleryController@store');
    Route::get('event','EventGalleryController@index');
    Route::get('event/destroy/{id}','EventGalleryController@destroy');
    Route::get('event/gallery/{eventid}',['as'=>'image.create','uses'=>'ImageController@create']);
    Route::post('event/gallery',['as'=>'image.store','uses'=>'ImageController@store']);
    Route::post('toggle/{id}','ImageController@toggle');
    Route::post('caption/{id}','ImageController@caption');
    Route::get('event/edit/{id}','EventGalleryController@edit');
    Route::post('event/edit/{id}','EventGalleryController@update');

    # Blog Routes
    Route::get('blog', 'BlogController@new_blog');
    Route::get('blog/new', 'BlogController@new_blog');
    Route::get('blog/list','BlogController@index');
    Route::get('blog/{id}', 'BlogController@show');
    Route::post('blog/store','BlogController@store');
    Route::get('blog/destroy/{id}','BlogController@destroy');
    Route::get('blog/edit/{id}','BlogController@edit');
    Route::post('blog/edit/{id}','BlogController@update');

    # Banner Routes
    Route::get('banner','BannerController@edit');
    Route::post('banner','BannerController@update');
    Route::get('banner/{id}','BannerController@destroy');

    # Change password routes
    Route::get('changePassword','Password@changePassword');
    Route::post('changePassword','Password@changePasswordProcess');
});
Route::get('/logout','Auth\AuthController@logout');
Route::get('/reset',function(){
    return view('auth.passwords.reset');
});
Route::post('/reset/password', 'ResetPasswordController@reset');
Route::post('/reset/verified', 'ResetPasswordController@change');
Route::get('/resetPasswordVerification/{token}', 'ResetPasswordController@verify');

