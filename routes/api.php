<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\ApI\EmployeeDataController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employees', [EmployeeController::class, 'index']);

Route::get('employee/getCountries', [EmployeeDataController::class, 'get_countries']);

Route::get('employee/{country}/getStates', [EmployeeDataController::class, 'get_states']);

Route::get('employee/{country}/{state}/getCities', [EmployeeDataController::class, 'get_cities']);

Route::get('employee/getDepartments', [EmployeeDataController::class, 'get_departments']);

Route::post('employee/store' , [EmployeeController::class , 'store']);

Route::get('employees/{id}' , [EmployeeController::class , 'edit']);

Route::put('employee/{id}/update' , [EmployeeController::class , 'update']);

Route::delete('employee/{id}/delete' , [EmployeeController::class , 'destroy']);

