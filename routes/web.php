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
