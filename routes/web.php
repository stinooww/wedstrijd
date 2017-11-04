<?php

/*
/Unauthenticated group
*/
Route::get('/', 'HomeController@show')
    ->name('homepage');

Route::get('/home', 'HomeController@show');
Route::get('/inschrijvingspagina', 'InschrijvingController@index')
    ->name('inschrijvingspagina');
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
Route::post('/inschrijving/store', 'InschrijvingController@store');
//Route::resource('inschrijving', 'InschrijvingController');
Route::get('/wedstrijd/wedstrijd', 'WedstrijdController@index')->name('wedstrijdindex');





/*
/Authenticated groups
*/
Auth::routes();

//Route::get('/admin/home', 'AdminController@show')
//->name('adminpagina');


Route::get('/dashboard/home', 'AdminController@index')->name('dashboard')->middleware('auth');


// wedstrijd
Route::group(['prefix' => '/wedstrijd', 'middleware' => 'auth'], function () {
    Route::get('/create', 'WedstrijdController@create')->name('getcreatewedstrijd');
    Route::post('/create', 'WedstrijdController@create')->name('createwedstrijd');
    Route::get('/edit/{id}', 'WedstrijdController@create')->name('geteditwedstrijd');
    Route::patch('/edit/{id}', 'WedstrijdController@edit')->name('editwedstrijd');
});

// deelnemers
Route::group(['prefix' => '/deelnemers', 'middleware' => 'auth'], function () {
    Route::get('/show', 'DeelnemerController@index')->name('deelnemerspagina');
    Route::patch('/edit', 'DeelnemerController@edit')->name('editdeelnemer');
});

//verantwoordelijke
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {

    Route::get('/show', 'AdminController@show')->name('adminindex');
    Route::post('/edit', 'AdminController@create')->name('admincreate');
    Route::post('/create', 'AdminController@update')->name('adminupdate');

});









// -----------CONFIG-----------
// ----------------------------
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function () {
    Route::get('/instellingen', 'ConfigController@index')
        ->name('config')
        ->middleware('auth');;
    Route::get('/instellingen/emailmanager/create', 'ConfigController@create')
        ->name('create_email_manager')
        ->middleware('auth');
    Route::post('/instellingen/emailmanager/create', 'ConfigController@create')
        ->name('create_email_manager')
        ->middleware('auth');
    Route::post('/instellingen/emailmanager/edit/{id}', 'ConfigController@editManager')
        ->name('edit_email_manager')
        ->middleware('auth');
    Route::get('/instellingen/emailmanager/edit/{id}', 'ConfigController@editManager')
        ->name('edit_email_manager')
        ->middleware('auth');
    Route::get('/instellingen/emailmanager/delete/{id}', 'ConfigController@deleteManager')
        ->name('delete_email_manager')
        ->middleware('auth');
});


// --------EXCEL------------
// -------------------------
Route::post('competition/participants/excel', 'ParticipantController@DownloadExcel')
    ->name('create_excel')
    ->middleware('auth');;
// --------SEND MAIL---------
// --------------------------
Route::post('competition/participants/mail', 'ParticipantController@SendMail')
    ->name('send_mail')
    ->middleware('auth');;
// --------PERMISSION-----------
// -------------------------
Route::get('/checkpermission', 'QuestionController@permission')
    ->name('permission');