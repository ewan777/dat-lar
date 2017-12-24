<?php

Route::get('/', [
  'uses' => 'Pages@home',
  'as' => 'home'
]);

Route::get('/about', 'Pages@about');

Route::group(['prefix'=>'user'], function(){

  Route::get('/register', [
    'uses' => 'Users@getRegister',
    'as'   => 'user.register',
    'middleware' =>'guest'
  ]);

  Route::post('/register', [
    'uses' => 'Users@postRegister',
    'as'   => 'user.register',
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

  Route::get('/reset-password', [
    'uses' => 'Users@getResetPassword',
    'as' => 'user.reset_password'
  ]);

  Route::post('/reset-password', [
    'uses' => 'Users@postResetPassword',
    'as' => 'user.reset_password'
  ]);

  Route::get('/new-password/{reset_code}', [
    'uses' => 'Users@getNewPassword',
    'as' => 'user.new_password'
  ]);

  Route::post('/new-password', [
    'uses' => 'Users@postNewPassword',
    'as' => 'user.new_password'
  ]);

});  //end of user route group

Route::get('/payment', [
  'uses' => 'Payments@getPayment',
  'as' => 'payment',
  'middleware' => 'auth'
]);

Route::post('/payment', [
  'uses' => 'Payments@postPayment',
  'as' => 'payment',
  'middleware' => 'auth'
]);

Route::get('/member-page', [
  'uses' => 'Memberships@getMemberPage',
  'as' => 'member_page',
  'middleware' =>'member'
]);


Route::group(['prefix'=>'profile'], function(){

  Route::get('/{user_id}', [
    'uses'       => 'Profiles@getProfile',
    'as'         => 'profile',
    'middleware' => 'auth'
  ]);

  Route::get('/new/{user_id}', [
    'uses'       => 'Profiles@getNew',
    'as'         => 'profile.new',
    'middleware' => 'auth'
  ]);

  Route::post('/new/{user_id}', [
    'uses'       => 'Profiles@postNew',
    'as'         => 'profile.create',
    'middleware' => 'auth'
  ]);

  Route::get('/{user_id}/edit', [
    'uses'       => 'Profiles@getEdit',
    'as'         => 'profile.edit',
    'middleware' => 'auth'
  ]);

  Route::put('/{user_id}/edit', [
    'uses'       => 'Profiles@putEdit',
    'as'         => 'profile.update',
    'middleware' =>'auth'
  ]);

  Route::get('/{user_id}/upload-image', [
    'uses'       => 'Profiles@uploadImage',
    'as'         => 'profile.upload_image',
    'middleware' => 'auth'
  ]);

  Route::post('/{user_id}/save-image', [
    'uses'       => 'Profiles@saveImage',
    'as'         => 'profile.save_image',
    'middleware' => 'auth'
  ]);

});


Route::group(['prefix'=>'message'], function(){

  Route::get('/{to_user_id}/new', [
    'uses'       => 'Messages@getMessage',
    'as'         => 'new_message',
    'middleware' => 'member'
  ]);

  Route::post('/{to_user_id}/new', [
    'uses'       => 'Messages@postMessage',
    'as'         => 'send_message',
    'middleware' => 'member'
  ]);

  Route::get('/{user_id}/sent', [
    'uses'       => 'Messages@sentMessages',
    'as'         => 'sent_messages',
    'middleware' => 'member'
  ]);

});
