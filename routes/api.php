<?php

<<<<<<< HEAD
use App\Http\Controllers\api\BranchController;
use App\Http\Controllers\api\CompanyController;




=======
use App\Http\Controllers\api\CompanyController;
>>>>>>> 9edfb186fe10dc1daff9486724fdce895556f593
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("companies/search", [CompanyController::class, 'search']);

// Route::get('companies/search', [CompanyController::class ,'companysearch']);
Route::apiResource('companies',CompanyController::class);
<<<<<<< HEAD
Route::apiResource('branches', BranchController::class);
=======

>>>>>>> 9edfb186fe10dc1daff9486724fdce895556f593
