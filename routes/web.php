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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
/** General views **/
//Home View
Route::get('/home', 'HomeController@index')->name('home');
//Log Out
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
/** Admin view **/
Route::middleware(['auth', 'role-users:1'])->group(function () {
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
});
/** People views **/
Route::middleware(['auth', 'role-users:2'])->group(function () {
    //Job Positions
    Route::get('/jobpositions', 'JobsPositionsController@index')->name('jobpositions.index');
    //Job Positions apply
    Route::match(['get', 'post'], '/jobpositions/apply/{id_jobs}', 'JobsPositionsController@apply')->name('jobpositions.apply');
});
/** Companies views **/
Route::middleware(['auth', 'role-users:3'])->group(function () {
    //Jobs View
    Route::get('/jobs', 'JobsController@index')->name('jobs.index');
    //Create Jobs method
    Route::match(['get', 'post'], '/jobs/create', 'JobsController@create')->name('jobs.create');
});
