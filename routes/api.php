<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Account\AccountController;

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

Route::prefix('v1')->group(function () {
    //total amounts  hierarchical view
    Route::get('/accounts/total-amounts-report'  , [AccountController::class, 'totalAmountsReport']);
    //total amounts table view
    Route::get('/accounts/total-amounts-table-view'  , [AccountController::class, 'totalAmountsTableReport']);

    }
);
