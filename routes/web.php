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
//Route::get('/admin/home', 'AdminController@show')
//->name('adminpagina');
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
    Route::get('/home', 'AdminController@show')->name('adminpagina');
    Route::get('/game', 'AdminController@game')->name('wedstrijd');
    Route::put('/verantwoordelijke-edit', 'AdminController@editVerantwoordelijke')->name('verantwoordelijke');
    Route::post('/verantwoordelijke-create', 'AdminController@storeVerantwoordelijke')->name('verantwoordelijkeCreate');
    Route::get('/deelnemer-show', 'AdminController@showDeelnemer')->name('deelnemerspagina');
    Route::put('/deelnemer-edit', 'AdminController@editDeelnemer')->name('editdeelnemerspagina');
});

//Route::get('/admin/home', ['as' =>'/admin/home', 'uses' => 'AdminController@show', 'middleware' => ['auth', 'admin']])


//Route::get('protected', ['as' =>'/deelnemer/show', 'uses' => 'PagesController@secure', 'middleware' => 'auth'])
//->name('deelnemerslijst');
//Route::get('', ['middleware' => ['auth', 'admin'], 'uses' => 'AdminController@show' ]);