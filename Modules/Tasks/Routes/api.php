<?php

use Illuminate\Http\Request;
use Modules\Tasks\Http\Controllers\TaskController;

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

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('tasks', [TaskController::class, 'create']);
    Route::get('get-user-tasks', [TaskController::class, 'getUserTasks']);
    Route::get('tasks/{id}', [TaskController::class, 'edit']);
    Route::patch('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
});

