<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('users', function()
{
    return View::make('users');
});

Route::get('user/{id}', 'UserController@showProfile');
Route::get("admin",function() {
	if(Auth::administrator()->check()) {
		return Redirect::to("admin/dashboard");
	} else {
		return Redirect::to("admin/login");
	}
});
Route::get('admin/login', 'Admin\DashboardController@login');
Route::post("admin/login","Admin\DashboardController@loginPost");
Route::get('admin/test', 'Admin\DashboardController@test');
Route::get("admin/logout",function() {
	Auth::administrator()->logout();
	return Redirect::to("admin/login");
});
Route::filter("admin_logged_in",function() {
	if(!Auth::administrator()->check()) {
		return Redirect::to("admin/login");
	} 
});

Route::group(array("before"=>"admin_logged_in"),function() {
	Route::get("admin/states/json-list", "Admin\StateController@jsonList");
	Route::resource("admin/restaurants","Admin\RestaurantController");
	Route::resource("admin/countries","Admin\CountryController");
	Route::resource("admin/menus","Admin\MenuController");
	Route::resource("admin/states","Admin\StateController");
	Route::resource('admin/dashboard',"Admin\DashboardController");
});

	
	
	



Route::resource("restaurant","RestaurantController");
