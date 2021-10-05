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

/**
 * ADMIN
 */
Route::group(['middleware' => 'auth:admins-api', 'prefix' => 'admin'], function(){
    Route::get('/disease-classifications/get-all', 'DiseaseClassificationController@getAllDiseaseClassifications');
    Route::get('/disease-classifications/get-disease-classification/{uuid}', 'DiseaseClassificationController@showDiseaseClassification');
    Route::post('/disease-classifications/store-disease-classification', 'DiseaseClassificationController@storeDiseaseClassification');
    Route::get('/disease-classifications/delete-disease-classification/{uuid}', 'DiseaseClassificationController@deleteDiseaseClassification');
    Route::post('/disease-classifications/get-disease-classifications', 'DiseaseClassificationController@getDiseaseClassification');
    Route::post('/disease-classifications/update-disease-classification/{uuid}', 'DiseaseClassificationController@updateDiseaseClassification');

});

/**
 * DOCTOR
 */
Route::group(['middleware' => 'auth:doctors-api', 'prefix' => 'doctor'], function(){
    Route::get('/disease-classifications/get-all', 'DiseaseClassificationController@getAllDiseaseClassifications');
    Route::get('/disease-classifications/get-disease-classification/{uuid}', 'DiseaseClassificationController@showDiseaseClassification');
    Route::post('/disease-classifications/store-disease-classification', 'DiseaseClassificationController@storeDiseaseClassification');
    Route::get('/disease-classifications/delete-disease-classification/{uuid}', 'DiseaseClassificationController@deleteDiseaseClassification');
    Route::post('/disease-classifications/get-disease-classifications', 'DiseaseClassificationController@getDiseaseClassifications');
    Route::post('/disease-classifications/update-disease-classification/{uuid}', 'DiseaseClassificationController@updateDiseaseClassification');
});

/**
 * PATIENT
 */
Route::group(['middleware' => 'auth:patients-api', 'prefix' => 'patient'], function(){
    Route::post('/disease-classifications/get-disease-classifications', 'DiseaseClassificationController@getDiseaseClassifications');
});