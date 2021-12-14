<?php

use App\Http\Controllers\PassingsController;
use App\Http\Controllers\QuestionsController;
use App\Models\Passings;
use App\Models\Question;
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

Route::post('/answer/{quiz:nickname}/{question}',[QuestionsController::class, 'handleAnswers']);//todo rename nickname and question (done)


