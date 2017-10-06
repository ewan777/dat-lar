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

Route::get('/', [
  'uses' => 'Pages@home',
  'as' => 'home'
]);
Route::get('/about', 'Pages@about');


Route::group(['prefix'=>'user'], function(){

  Route::get('/signup', [
    'uses' => 'Users@getSignup',
    'as'   => 'user.signup',
    'middleware' =>'guest'
  ]);

  Route::post('/signup', [
    'uses' => 'Users@postSignup',
    'as'   => 'user.signup',
    'middleware' =>'guest'
  ]);

  Route::get('/login', [
    'uses' => 'Users@getLogin',
    'as'   => 'user.login',
    'middleware' =>'guest'
  ]);

  Route::post('/login', [
    'uses' => 'Users@postLogin',
    'as'   => 'user.login',
    'middleware' =>'guest'
  ]);

  Route::get('/logout', [
    'uses' => 'Users@getLogout',
    'as'   => 'user.logout',
    'middleware' =>'auth'
  ]);

  Route::get('/profile', [
    'uses' => 'Users@getProfile',
    'as' => 'user.profile',
    'middleware' =>'auth'
  ]);

  Route::get('/registered/{confirmation_code}', [
    'uses' => 'Users@getRegistered',
    'as' => 'user.registered'
  ]);

  Route::get('/resend-activation', [
    'uses' => 'Users@getResendActivation',
    'as' => 'user.resend_activation'
  ]);

  Route::post('/resend-activation', [
    'uses' => 'Users@postResendActivation',
    'as' => 'user.resend_activation'
  ]);

});
