<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\{
    CompanyController,
    EmployeeController
};

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
Route::middleware('api')->group(function (){
    Route::get('companies/list', [CompanyController::class, 'getCompanies'])->name('companies.list');
    Route::get('employees/list', [EmployeeController::class, 'getEmployees'])->name('employees.list');
});
