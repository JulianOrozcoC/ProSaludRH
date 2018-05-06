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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
Route::get('/account-settings', 'AccountController@getIndex')->name('account-settings')->middleware('auth');
Route::post('/account-settings', 'AccountController@postIndex');
Route::get('/organizations', 'OrganizationsController@getIndex')->name('organizations')->middleware('auth');
Route::post('/organizations', 'OrganizationsController@postIndex')->middleware('auth');
Route::post('/deleteOrganization', 'OrganizationsController@postDelete')->middleware('auth');
Route::get('/staff', 'StaffController@getIndex')->name('staff')->middleware('auth');
Route::post('/setPassword/{user}', 'StaffController@postPassword');
Route::post('/staff', 'StaffController@postIndex')->middleware('auth');
Route::post('/staff/delete/{user}', 'StaffController@deleteUser')->middleware('auth');
Route::get('/credits', 'CreditsController@getIndex')->middleware('auth');
Route::get('/credits/assignation', 'CreditsController@creditsAssignation')->middleware('auth');
Route::post('/credits/assignation', 'CreditsController@postCreditsAssignation')->middleware('auth');
Route::get('/tests', 'TestsController@getIndex')->middleware('auth');
Route::post('/editTest/{id}', 'TestsController@postEditName')->middleware('auth');
Route::post('/credits', 'CreditsController@postCreate')->middleware('auth');
Route::get('/create', 'OrganizationsController@create')->middleware('auth');
Route::get('/show/{id}', 'OrganizationsController@showOrganizationInfo')->middleware('auth');
Route::get('/testApplications/{testApplication}', 'TestApplicationsController@getTest')->middleware('auth');
Route::get('/completed-test/{testApplication}', 'TestApplicationsController@getCompleted')->middleware('auth');
Route::post('/testApplications/{testApplication}', 'TestApplicationsController@postTest')->middleware('auth');
Route::get('/activeapplications', 'TestApplicationsController@getActive')->middleware('auth');
Route::get('/completedapplications', 'TestApplicationsController@getAllComplete')->middleware('auth');


Route::get('/email-confirmation/{token}', [
    'as' => 'email-confirmation',
    'uses' => 'StaffController@confirmationEmail'
]);
