<?php

use App\Http\Controllers\Backend\ChangePasswordController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\UserController;

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();



Route::resource('/users', UserController::class);

Route::patch('/user/{id}/changePassword', [ChangePasswordController::class, 'changePassword'])->name('changePassword');

Route::resource('/countries', CountryController::class);

Route::resource('/states', StateController::class);

Route::resource('/cities', CityController::class);

Route::get('/getStates/{id}', [CityController::class, 'getStates']);

Route::resource('/departments', DepartmentController::class);

Route::resource('/roles', RolesController::class);


Route::get('/{any}', function () {
    return view('employees.index');
})->where('any', '.*');
