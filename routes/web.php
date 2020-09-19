<?php

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

Route::get('/', 'WelcomeController@home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register-company', 'WelcomeController@registerCompany');
Route::post('/store-company', 'WelcomeController@saveCompany')->name('store-company');
Route::get('job-form', 'CompanyController@JobForm');
Route::get('doashboard', 'CompanyController@dashboard');
Route::post('create-job', 'CompanyController@createJob')->name('create-job');
Route::get('job-details/{slug}', 'WelcomeController@Detailsjob');
Route::get('profile', 'ApplicantController@profileForm');
Route::post('create-profile', 'ApplicantController@createProfile')->name('create-profile');
Route::post('update-profile', 'ApplicantController@UpdateProfile')->name('update-profile');
Route::get('apply_job/{slug}', 'CompanyController@applyjob');
