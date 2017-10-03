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

Route::get('/signup', [
  'uses' => 'Users@getSignup',
  'as'   => 'user.signup'
]);

Route::post('/signup', [
  'uses' => 'Users@postSignup',
  'as'   => 'user.signup'
]);

Route::get('/login', [
  'uses' => 'Users@getLogin',
  'as'   => 'user.login'
]);

Route::post('/login', [
  'uses' => 'Users@postLogin',
  'as'   => 'user.login'
]);

Route::get('/profile', [
  'uses' => 'Users@getProfile',
  'as' => 'user.profile'
]);

Route::get('/registered/{confirmation_code}', [
  'uses' => 'Users@getRegistered',
  'as' => 'user.registered'
]);
