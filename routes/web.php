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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('fashions', 'FashionsController',['only'=>['create','store','show','edit','update','destroy']]);
    Route::resource('users', 'UsersController', ['only' => ['show','edit','update']]);
    Route::get('timeline','UsersController@timeline')->name('user.timeline');
    Route::get('ranking','FashionsController@ranking')->name('fashions.ranking');
    
    Route::group(['prefix' => 'user/{id}'], function(){
        Route::post('favorite','FavoritesController@store')->name('fashion.favorite');
        Route::delete('unfavorite','FavoritesController@destroy')->name('fashion.unfavorite');
        Route::post('follow','FollowsController@store')->name('user.follow');
        Route::delete('unfollow','FollowsController@destroy')->name('user.unfollow');
        Route::get('followings','UsersController@followings')->name('user.followings');
        Route::get('followers','UsersController@followers')->name('user.followers');
        Route::get('mypage','UsersController@mypage')->name('user.mypage');
        Route::get('favorites','UsersController@favorites')->name('user.favorites');
    });
});