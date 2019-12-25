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

Route::get('/', 'FashionsController@index')->name('fashion.index');


Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::get('ranking','FashionsController@ranking')->name('fashion.ranking');
Route::get('keyword','SearchController@keyword')->name('fashion.keyword');
Route::get('category/{id}','SearchController@category')->name('fashion.category');
Route::get('fashions/{id}/show', 'FashionsController@show')->name('fashion.show');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider')->name('socialite.login');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::group(['prefix' => 'user/{id}'], function(){
    Route::get('show', 'UsersController@show')->name('users.show'); 
    Route::get('followings','UsersController@followings')->name('user.followings');
    Route::get('followers','UsersController@followers')->name('user.followers');
    Route::get('favorites','UsersController@favorites')->name('user.favorites'); 
    });

Route::group(['middleware' => 'auth'], function () {
    Route::resource('fashions', 'FashionsController',['only'=>['create','store','edit','update','destroy']]);
    Route::resource('users', 'UsersController', ['only' => ['edit','update']]);
    Route::get('timeline','UsersController@timeline')->name('user.timeline');
  
    Route::group(['prefix' => 'user/{id}'], function(){
        Route::post('follow','FollowController@store')->name('user.follow');
        Route::delete('unfollow','FollowController@destroy')->name('user.unfollow');
    });
    
     Route::group(['prefix' => 'fashion/{id}'], function () {
        Route::post('favorite','FavoriteController@store')->name('fashion.favorite');
        Route::delete('unfavorite','FavoriteController@destroy')->name('fashion.unfavorite');
    });
});
