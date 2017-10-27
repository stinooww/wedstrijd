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

Route::get('/', 'HomeController@show')
    ->name('homepage');
/*
/Unauthenticated group
*/
Route::get('/home', 'HomeController@show');
Route::get('/inschrijvingspagina', 'InschrijvingController@index')
    ->name('inschrijvingspagina');
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::post('/inschrijving/store', 'InschrijvingController@store');
Route::resource('inschrijving', 'InschrijvingController');

/*
/Authenticated group
*/
Auth::routes();