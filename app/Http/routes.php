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

// API Routes

Route::group(['prefix' => 'api/v1', 'middleware' => 'cors'], function () {

    // Public Routes
    Route::get('public/centres', 'Api\CentreController@indexByPublic');
    Route::get('public/ecd_qualifications', 'Api\ECDQualificationController@indexByPublic');

    // Auth
    Route::post('staff/login', 'Api\StaffAuthController@postLogin');
    //Route::post('staff/register', 'Api\StaffAuthController@postRegister');

    Route::get('class/centre/{id}', 'Api\CentreClassController@indexByCentre');
    Route::get('class/attendance/{staff_id}', 'Api\ChildAttendanceController@byClass');
    Route::get('child/class/{id}/{orderBy?}', 'Api\ChildController@byClass');
    Route::post('child', 'Api\ChildController@addChild');
    Route::post('attendance/bulk', 'Api\ChildAttendanceController@bulk');
    Route::get('centre/{id}/summary', 'Api\CentreController@summary');
    Route::get('attendance/{centreId}/history/{year?}/{month?}', 'Api\ChildAttendanceController@history');

    // update endpoints for submitting DIDs, should be called only by API v2
    Route::patch('child/{child}', 'Api\ChildController@update');
    Route::patch('staff/{staff}', 'Api\StaffController@update');
    Route::patch('centre/{centre}', 'Api\CentreController@update');
});

// File Routes
Route::get('/files', 'FilesController@index')->name('index');
Route::get('getDownload/{filename}', 'FilesController@getDownload')->name('getDownload');

// Laravel Application Routes
Route::get('/', 'HomeController@index')->name('home');
Route::get('login', 'HomeController@getLogin')->name('getLogin');
Route::post('login', 'Auth\AuthController@login')->name('postLogin');
Route::get('logout', 'Auth\AuthController@logout')->name('logout');

// Dashboard Google Maps Endpoint
Route::get('/gmaps', 'HomeController@getCentresAttendanceMarkers')->name('googleMapsMarkers');

// Centre Routes
Route::get('centre', 'CentreController@index')->name('centre.index');
Route::post('centre', 'CentreController@store')->name('centre.store');
Route::get('centre/create', 'CentreController@create')->name('centre.create');
Route::get('centre/{centre}/delete', 'CentreController@delete')->name('centre.delete');
Route::get('centre/{centre}/destroy', 'CentreController@destroy')->name('centre.destroy');
Route::patch('centre/{centre}/update', 'CentreController@update')->name('centre.update');
Route::get('centre/{centre}/edit', 'CentreController@edit')->name('centre.edit');
Route::get('centre/search', 'CentreController@search')->name('centre.search');

// Staff Routes
Route::get('staff', 'StaffController@index')->name('staff.index');
Route::post('staff', 'StaffController@store')->name('staff.store');
Route::get('staff/create', 'StaffController@create')->name('staff.create');
Route::get('staff/{staff}/delete', 'StaffController@delete')->name('staff.delete');
Route::get('staff/{staff}/destroy', 'StaffController@destroy')->name('staff.destroy');
Route::patch('staff/{staff}/update', 'StaffController@update')->name('staff.update');
Route::get('staff/{staff}/edit', 'StaffController@edit')->name('staff.edit');
Route::get('staff/search', 'StaffController@search')->name('staff.search');

// CentreClass Routes
Route::get('class', 'CentreClassController@index')->name('centreClass.index');
Route::post('class', 'CentreClassController@store')->name('centreClass.store');
Route::get('class/create', 'CentreClassController@create')->name('centreClass.create');
Route::get('class/{centreClass}/delete', 'CentreClassController@delete')->name('centreClass.delete');
Route::get('class/{centreClass}/destroy', 'CentreClassController@destroy')->name('centreClass.destroy');
Route::patch('class/{centreClass}/update', 'CentreClassController@update')->name('centreClass.update');
Route::get('class/{centreClass}/edit', 'CentreClassController@edit')->name('centreClass.edit');
Route::get('class/search', 'CentreClassController@search')->name('centreClass.search');

// Children Routes
Route::get('children', 'ChildController@index')->name('child.index');
Route::post('children', 'ChildController@store')->name('child.store');
Route::get('children/create', 'ChildController@create')->name('child.create');
Route::get('children/{child}/delete', 'ChildController@delete')->name('child.delete');
Route::get('children/{child}/destroy', 'ChildController@destroy')->name('child.destroy');
Route::patch('children/{child}/update', 'ChildController@update')->name('child.update');
Route::get('children/{child}/edit', 'ChildController@edit')->name('child.edit');
Route::get('children/search', 'ChildController@search')->name('child.search');
Route::post('children/add_by_id', 'ChildController@addFetchByTIM')->name('child.addFetchByTIM');
Route::post('children/update_by_id/{child}', 'ChildController@updateFetchByTIM')->name('child.updateFetchByTIM');
Route::get('children/without_id', 'ChildController@withoutId')->name('child.withoutId');
Route::get('children/invalid_id', 'ChildController@invalidId')->name('child.invalidId');

// Attendance Routes
Route::get('attendance', 'ChildAttendanceController@index')->name('childAttendance.index');
Route::post('attendance', 'ChildAttendanceController@store')->name('childAttendance.store');
Route::get('attendance/create', 'ChildAttendanceController@create')->name('childAttendance.create');
Route::get('attendance/{childAttendance}/delete', 'ChildAttendanceController@delete')->name('childAttendance.delete');
Route::get('attendance/{childAttendance}/destroy', 'ChildAttendanceController@destroy')->name('childAttendance.destroy');
Route::patch('attendance/{childAttendance}/update', 'ChildAttendanceController@update')->name('childAttendance.update');
Route::get('attendance/{childAttendance}/edit', 'ChildAttendanceController@edit')->name('childAttendance.edit');
Route::get('attendance/create/byClass', 'ChildAttendanceController@createByClass')->name('childAttendance.createByClass');
Route::post('attendance/create/byClass', 'ChildAttendanceController@storeByClass')->name('childAttendance.storeByClass');
Route::get('attendance/retrieve/classes/{centreId}', 'ChildAttendanceController@retrieveClasses')->name('childAttendance.retrieveClasses');
Route::get('attendance/retrieve/children/{classId}', 'ChildAttendanceController@retrieveChildren')->name('childAttendance.retrieveChildren');

// Administrator Routes
Route::get('administrator', 'AdminController@index')->name('admin.index');
Route::post('administrator', 'AdminController@store')->name('admin.store');
Route::get('administrator/create', 'AdminController@create')->name('admin.create');
Route::get('administrator/{admin}/delete', 'AdminController@delete')->name('admin.delete');
Route::get('administrator/{admin}/destroy', 'AdminController@destroy')->name('admin.destroy');
Route::patch('administrator/{admin}/update', 'AdminController@update')->name('admin.update');
Route::get('administrator/{admin}/edit', 'AdminController@edit')->name('admin.edit');

// External (3rd Party Admin Routes)
Route::get('external/web', 'ExternalUserController@index')->name('externalUser.index');
Route::get('external/web/create', 'ExternalUserController@create')->name('externalUser.create');
Route::post('external/web', 'ExternalUserController@store')->name('externalUser.store');
Route::get('external/web/{user}/delete', 'ExternalUserController@delete')->name('externalUser.delete');
Route::get('external/web/{user}/destroy', 'ExternalUserController@destroy')->name('externalUser.destroy');
Route::patch('external/web/{user}/update', 'ExternalUserController@update')->name('externalUser.update');
Route::get('external/web/{user}/edit', 'ExternalUserController@edit')->name('externalUser.edit');


Route::get('external/api', 'ExternalApiController@index')->name('externalApiUser.index');
Route::get('external/api/create', 'ExternalApiController@create')->name('externalApiUser.create');
Route::post('external/api', 'ExternalApiController@store')->name('externalApiUser.store');
Route::get('external/api/{user}/delete', 'ExternalApiController@delete')->name('externalApiUser.delete');
Route::get('external/api/{user}/destroy', 'ExternalApiController@destroy')->name('externalApiUser.destroy');
Route::patch('external/api/{user}/update', 'ExternalApiController@update')->name('externalApiUser.update');
Route::get('external/api/{user}/edit', 'ExternalApiController@edit')->name('externalApiUser.edit');
Route::get('external/api/{user}/refreshToken', 'ExternalApiController@refreshToken')->name('externalApiUser.refreshToken');


// External API Endpoints
Route::group(['prefix' => 'external/api/v1', 'middleware' => 'cors'], function () {
    Route::get('centre', 'ExternalApi\CentreController@index');
    Route::get('staff', 'ExternalApi\StaffController@index');
    Route::get('class', 'ExternalApi\CentreClassController@index');
    Route::get('child', 'ExternalApi\ChildController@index');
    Route::get('attendance', 'ExternalApi\ChildAttendanceController@index');
});
