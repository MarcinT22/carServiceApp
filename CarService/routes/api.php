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

Route::group([
    'middleware' => 'auth:api'
], function() {
    Route::get('logout', 'Api\UserApiController@logout');
    Route::get('user', 'Api\UserApiController@user');
});


Route::group([
    'middleware' => 'auth:cars-api'
], function() {

    Route::post('reportedMyCar','Api\ReportedCarApiController@storeWithMyCar');
});

Route::post('cars/login', 'Api\CarApiController@login');
Route::get('cars','Api\CarApiController@list');
Route::post('cars','Api\CarApiController@store');
Route::put('cars/{id}','Api\CarApiController@update');
Route::delete('cars/{id}','Api\CarApiController@destroy');
Route::get('cars/{id}','Api\CarApiController@find');
Route::get('getCarsModels','Api\CarApiController@getCarsModels');



Route::get('reportedCars','Api\ReportedCarApiController@list');
Route::post('reportedNewCar','Api\ReportedCarApiController@storeWithNewCars');
Route::put('reportedCars/{id}','Api\ReportedCarApiController@update');
Route::delete('reportedCars/{id}','Api\ReportedCarApiController@destroy');
Route::get('reportedCars/{id}','Api\ReportedCarApiController@find');

Route::get('getNotAcceptedReportedCars','Api\ReportedCarApiController@getNotAccepted');
Route::get('getAcceptedReportedCars','Api\ReportedCarApiController@getAccepted');
Route::get('acceptReportedCar/{id}','Api\ReportedCarApiController@acceptDate');
Route::get('checkIfCarIsReported/{id}','Api\ReportedCarApiController@checkIfCarIsReported');
Route::get('getCarDeliveries','Api\ReportedCarApiController@getCarDeliveries');
Route::get('confirmCarDelivery/{id}','Api\ReportedCarApiController@confirmCarDelivery');

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
Route::get('getEventStatus/{reportedCarId}','Api\EventApiController@getEventStatus');
Route::get('getNewEvents','Api\EventApiController@getNewEvents');
Route::get('getSheduledEvents','Api\EventApiController@getSheduledEvents');
Route::get('getReadyCars','Api\EventApiController@getReadyCars');




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

Route::get('getStatistics','Api\StatisticsApiController@getStatistics');


