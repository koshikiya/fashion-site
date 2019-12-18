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

Route::get('/', 'FashionsController@index')->name('fashions.index');


Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');
Route::get('ranking','FashionsController@ranking')->name('fashions.ranking');

Route::group(['prefix' => 'fashion/{id}'], function () {
    Route::get('show','FashionsController@show')->name('fashions.show');
    Route::get('category','FashionsController@category')->name('fashion.category');
});

Route::group(['prefix' => 'user/{id}'], function(){
    Route::get('followings','UsersController@followings')->name('user.followings');
    Route::get('followers','UsersController@followers')->name('user.followers');
    Route::get('favorites','UsersController@favorites')->name('user.favorites'); 
    Route::get('show', 'UsersController@show')->name('users.show');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::resource('fashions', 'FashionsController',['only'=>['create','store','edit','update','destroy']]);
    Route::resource('users', 'UsersController', ['only' => ['edit','update']]);
    Route::get('timeline','UsersController@timeline')->name('user.timeline');
  
    Route::group(['prefix' => 'user/{id}'], function(){
        Route::post('follow','FollowsController@store')->name('user.follow');
        Route::delete('unfollow','FollowsController@destroy')->name('user.unfollow');
    });
    
     Route::group(['prefix' => 'fashion/{id}'], function () {
        Route::post('favorite','FavoritesController@store')->name('fashion.favorite');
        Route::delete('unfavorite','FavoritesController@destroy')->name('fashion.unfavorite');
    });
});