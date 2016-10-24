<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');


Route::resource('profile', 'ProfileController');

Route::resource('company', 'CompanyController');

Route::resource('CompanyList', 'ListCompanyController');


//testing
Route::get('test', function(){
	return view('company/create_company');
});

Route::get('api/category-dropdown/{id}', 'ApiController@categoryDropDownData')->where('id', '[0-9]+');