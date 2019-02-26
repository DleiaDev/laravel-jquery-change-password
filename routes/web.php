<?php

use Illuminate\Http\Request;

Auth::routes();

Route::view('/', 'welcome');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/password', function (Request $request) {

    // Get the user
    $user = auth()->user();

    $errors = (object)[];

    // Check if current password matches
    if (!Hash::check($request->old_password, $user->password)) {
      $errors->old_password = 'Incorrect current password.';
      return response(['errors' => $errors]);
    }

    // Check if current password and new password are the same
    if (strcmp($request->old_password, $request->new_password) == 0) {
      $errors->new_password = 'New password and current password cannot be the same.';
      return response(['errors' => $errors]);
    }

    // Validate
    $validator = Validator::make($request->all(), [
      'old_password' => 'required',
      'new_password' => 'required|min:6',
      'new_password_repeat' => 'required'
    ]);
    if ($validator->fails()) {
      return response(['errors' => $validator->errors()]);
    }

    // Check if new password and repeated password are NOT the same
    if (strcmp($request->new_password, $request->new_password_repeat) != 0) {
      $errors->new_password = 'New password and repeated password have to be the same.';
      $errors->new_password_repeat = 'New password and repeated password have to be the same.';
      return response(['errors' => $errors]);
    }

    // Change password
    $user->password = bcrypt($request->new_password);
    $user->save();

    return response(['success' => 'true']);

})->middleware('auth');
