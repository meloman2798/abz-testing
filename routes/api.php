<?php

use App\Http\Controllers\API\V1\UserAPIController;
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

Route::group(['middleware' => 'apiToken', 'prefix' => 'v1'], function () {
    Route::post('/user/create', [UserAPIController::class, 'create']);
    Route::post('/user/update', [UserAPIController::class, 'update']);
    Route::post('/user/delete', [UserAPIController::class, 'delete']);
});
