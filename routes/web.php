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

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/organizations', 'OrganizationsController@getIndex')->name('organizations');
Route::post('/organizations', 'OrganizationsController@postIndex');
Route::post('/deleteOrganization', 'OrganizationsController@postDelete');
Route::get('/staff', 'StaffController@getIndex')->name('staff');
Route::post('/setPassword/{user}', 'StaffController@postPassword');
Route::post('/staff', 'StaffController@postIndex');
Route::get('/credits', 'CreditsController@getIndex');
Route::get('/tests', 'TestsController@getIndex');
Route::post('/editTest/{id}', 'TestsController@postEditName');
Route::post('/credits', 'CreditsController@postCreate');
Route::get('/create', 'OrganizationsController@create');
Route::get('/show/{id}', 'OrganizationsController@showOrganizationInfo');

Route::get('/email-confirmation/{token}', [
    'as' => 'email-confirmation',
    'uses' => 'StaffController@confirmationEmail'
]);
