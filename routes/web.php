<?php

/*
/Unauthenticated group
*/
Route::get('/', 'HomeController@show')
    ->name('homepage');

Route::get('/home', 'HomeController@show');
Route::get('/inschrijving/inschrijving', 'RegisterController@index')
    ->name('inschrijvingspagina');
//Route::get('/redirect', 'SocialAuthFacebookController@redirect');
//Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::post('/inschrijving/store', 'RegisterController@store');

Route::get('/wedstrijd/wedstrijd', 'GameController@index')->name('wedstrijdindex');





/*
/Authenticated groups
*/
Auth::routes();

//Route::get('/admin/home', 'AdminController@show')
//->name('adminpagina');


Route::get('/dashboard/home', 'AdminController@index')->name('dashboard')->middleware('auth');


// wedstrijd
Route::group(['prefix' => '/wedstrijd', 'middleware' => 'auth'], function () {

    Route::get('/create', 'GameController@create')->name('createwedstrijd');
    Route::post('/create', 'GameController@create')->name('createwedstrijd');
    Route::get('/edit/{id}', 'GameController@update')->name('editwedstrijd');
    Route::post('/edit/{id}', 'GameController@update')->name('editwedstrijd');
});


// deelnemers
Route::group(['prefix' => '/deelnemers', 'middleware' => 'auth'], function () {
    Route::get('/show', 'ParticipantController@index')->name('deelnemerspagina');
    Route::get('/edit/{id}', 'ParticipantController@edit')->name('editdeelnemer');
    Route::post('/edit/{id}', 'ParticipantController@edit')->name('editdeelnemer');
});

//verantwoordelijke
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {

    Route::get('/show', 'AdminController@show')->name('adminindex');
    Route::get('/edit/{id}', 'AdminController@update')->name('adminupdate');
    Route::post('/edit/{id}', 'AdminController@update')->name('adminupdate');
//    Route::post('/create', 'AdminController@update')->name('adminupdate');

});


// excel
Route::post('deelnemers/show/excel', 'ParticipantController@DownloadExcel')->middleware('auth')->name('excel');
// email
Route::post('deelnemers/show/mail', 'ParticipantController@SendMail')->middleware('auth')->name('email');
//Route::post('deelnemers/show/mail/{id}', 'ParticipantController@SendWinningMail')->middleware('auth')->name('email');

//facebook share

//Route::get('/wedstrijd/wedstrijd', function()
//{
//    return Share::load('https://wedstrijd.stijn.heynderickx.mtantwerp.eu/', 'Jupiler game')->facebook();
//});

