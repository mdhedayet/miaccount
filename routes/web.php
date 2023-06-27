<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Account\AccountController;

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

Route::get('/ass',[AccountController::class, 'accountHeadWithGroup']);

Route::get('{any}', fn () => view('app'))->where('any', '^((?!api).)*');
