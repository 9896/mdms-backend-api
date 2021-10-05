<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/symptom', function (Request $request) {
    return $request->user();
});
/**
 * ADMIN
 */
Route::group(['middleware' => 'auth:admins-api', 'prefix' => 'admin'], function(){
    Route::get('/symptoms/get-all/{get?}', 'SymptomController@getAllSymptoms');
    Route::get('/symptoms/get-symptom/{uuid}', 'SymptomController@showSymptom');
    Route::post('/symptoms/store-symptom', 'SymptomController@storeSymptom');
    Route::post('/symptoms/delete-symptom/{uuid}', 'SymptomController@deleteSymptom');
    Route::post('/symptoms/get-symptoms', 'SymptomController@getSymptoms');
    Route::post('/symptoms/update-symptom/{uuid}', 'SymptomController@updateSymptom');

});

/**
 * DOCTOR
 */
Route::group(['middleware' => 'auth:doctors-api', 'prefix' => 'doctor'], function(){
    Route::get('/symptoms/get-all', 'SymptomController@getAllSymptoms');
    Route::get('/symptoms/get-symptom/{uuid}', 'SymptomController@showSymptom');
    Route::post('/symptoms/store-symptom', 'SymptomController@storeSymptom');
    Route::get('/symptoms/delete-symptom/{uuid}', 'SymptomController@deleteSymptom');
    Route::post('/symptoms/get-symptoms', 'SymptomController@getSymptoms');
    Route::post('/symptoms/update-symptom/{uuid}', 'SymptomController@updateSymptom');
});

/**
 * PATIENT
 */
Route::group(['middleware' => 'auth:patients-api', 'prefix' => 'patient'], function(){
    Route::post('/symptoms/get-symptoms', 'SymptomController@getSymptoms');
});