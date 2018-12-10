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

Route::get('/set_language/{lang}','controller@setLanguage')->name('set_language');

Route::get('login/{driver}', 'Auth\LoginController@redirectToProvider')->name('social_auth');
Route::get('login/{driver}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'courses'], function () {
    Route::get('/{course}','CourseController@show')->name('courses.detail');
});

Route::group(["prefix" => "subscriptions"], function(){
    Route::get('/plans', 'SubscriptionController@plans')->name('subscriptions.plans');
    Route::get('/admin', 'SubscriptionController@admin')->name('subscriptions.admin');
    Route::post('/process_subscription', 'SubscriptionController@processSubscription')->name('subscriptions.process_subscription');
});


Route::get('/images/{path}/{attachment}', function ($path,$attachment) {
    $file = sprintf('storage/%s/%s',$path,$attachment);
    if(File::exists($file)){
        return \Intervention\Image\Facades\Image::make($file)->response();
    }
});
