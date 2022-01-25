<?php

use App\Cognito\CognitoClient;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', function () {
    try {
        $email    = 'mishajib222@gmail.com';
        $password = 'i am back222S@$&';

        $attributes = [
            'name'  => 'MI SHAJIB',
            'email' => $email,
        ];

        app()->make(CognitoClient::class)->register($email, $password, $attributes);

        dd('Registered successfully.');
    } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $exception) {
        dd($exception->getAwsErrorMessage());
    }
});


Route::get('email-confirm', function () {
    try {
        $username = 'mishajib222@gmail.com';
        $otp      = '972889';


        app()->make(CognitoClient::class)->emailConfirmation($username, $otp);

        dd('Email verified successfully.');
    } catch (\Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException $exception) {
        dd($exception->getAwsErrorMessage());
    }
});
