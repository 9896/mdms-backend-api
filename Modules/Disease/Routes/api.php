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

/*
*ADMIN
 */
Route::group(['middleware' => 'auth:admins-api', 'prefix' => 'admin'], function(){
    Route::get('/diseases/get-all', 'DiseaseController@getAllDiseases');
    Route::get('/diseases/get-disease/{uuid}', 'DiseaseController@showDisease');
    Route::post('/diseases/store-disease', 'DiseaseController@storeDisease');
    Route::post('/diseases/delete-disease/{uuid}', 'DiseaseController@deleteDisease');
    Route::post('/diseases/get-diseases', 'DiseaseController@getDiseases');
    Route::post('/diseases/update-disease/{uuid}', 'DiseaseController@updateDisease');

});

/**
 * DOCTOR
 */
Route::get('/diseases/get-all', 'DiseaseController@getAllDiseases');
Route::group(['middleware' => 'auth:doctors-api', 'prefix' => 'doctor'], function(){

    Route::get('/diseases/get-disease/{uuid}', 'DiseaseController@showDisease');
    Route::post('/diseases/store-disease', 'DiseaseController@storeDisease');
    Route::get('/diseases/delete-disease/{uuid}', 'DiseaseController@deleteDisease');
    Route::post('/diseases/get-diseases', 'DiseaseController@getDiseases');
    Route::post('/diseases/update-disease/{uuid}', 'DiseaseController@updateDisease');

});

/**
 * PATIENT
 */
Route::group(['middleware' => 'auth:patients-api', 'prefix' => 'patient'], function(){
    //Route::get('/diseases/get-all', 'DiseaseController@getAllDiseases');
    Route::get('/diseases/get-disease/{uuid}', 'DiseaseController@showDisease');
    Route::post('/diseases/get-diseases', 'DiseaseController@getDiseases');
});