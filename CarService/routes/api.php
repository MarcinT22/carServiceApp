<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Api\UserApiController@login');
Route::post('register', 'Api\UserApiController@register');

Route::get('cars','Api\CarApiController@list');
Route::post('cars','Api\CarApiController@store');
Route::put('cars/{id}','Api\CarApiController@update');
Route::delete('cars/{id}','Api\CarApiController@destroy');
Route::get('cars/{id}','Api\CarApiController@find');


Route::get('reported-cars','Api\ReportedCarApiController@list');
Route::post('reported-cars','Api\ReportedCarApiController@store');
Route::put('reported-cars/{id}','Api\ReportedCarApiController@update');
Route::delete('reported-cars/{id}','Api\ReportedCarApiController@destroy');
Route::get('reported-cars/{id}','Api\ReportedCarApiController@find');

Route::get('statuses','Api\StatusApiController@list');
Route::post('statuses','Api\StatusApiController@store');
Route::put('statuses/{id}','Api\StatusApiController@update');
Route::delete('statuses/{id}','Api\StatusApiController@destroy');
Route::get('statuses/{id}','Api\StatusApiController@find');

Route::get('events','Api\EventApiController@list');
Route::post('events','Api\EventApiController@store');
Route::put('events/{id}','Api\EventApiController@update');
Route::delete('events/{id}','Api\EventApiController@destroy');
Route::get('events/{id}','Api\EventApiController@find');

Route::get('alerts','Api\AlertApiController@list');
Route::post('alerts','Api\AlertApiController@store');
Route::put('alerts/{id}','Api\AlertApiController@update');
Route::delete('alerts/{id}','Api\AlertApiController@destroy');
Route::get('alerts/{id}','Api\AlertApiController@find');

Route::get('calendars','Api\CalendarApiController@list');
Route::post('calendars','Api\CalendarApiController@store');
Route::put('calendars/{id}','Api\CalendarApiController@update');
Route::delete('calendars/{id}','Api\CalendarApiController@destroy');
Route::get('calendars/{id}','Api\CalendarApiController@find');