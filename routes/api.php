<?php

use App\Http\Controllers\Api\TypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Projectt;
use App\Http\Controllers\Api\ProjectController;


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

Route::get("/projects", [ProjectController::class, "index"] );

Route::apiResource("projects", ProjectController::class)->only(["index","show"]);

Route::apiResource("types", TypeController::class)->only(["show"]);