<?php

use App\Http\Controllers\PassingsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizController;
use App\Models\Passings;
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
    return view('welcome');
});
Route::post('/quiz/run',[PassingsController::class, 'create']);


Route::get('/quiz/{nickname}', [PassingsController::class, 'index']);


Route::get('/quiz/leaderboard',function () {
    return view('quizes.results');
});
