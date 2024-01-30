<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/createcandidateform', function () {
    return view('createcandidate');
});

Route::get('/generatequiz/{id}', [QuestionController::class, 'generateQuiz']);
Route::post('startquiz', [QuestionController::class,'startQuiz']);

Route::post('/storequiz', [QuestionController::class,'storequiz']);