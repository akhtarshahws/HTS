<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// candidate route
Route::get('/getcandidate', [CandidateController::class, 'getCandidate']);
Route::get('/getcandidate/{id}/edit', [CandidateController::class, 'edit'])->name('getcandidate.edit');
Route::put('/candidate/{id}/update', [CandidateController::class, 'update'])->name('candidate.update');
Route::delete('/candidate/{id}/delete', [CandidateController::class, 'destroy'])->name('candidate.delete');

Route::post('/createcandidate', [CandidateController::class,'storeCandidate']);

//   question route
Route::get('/getquestion', [QuestionController::class, 'getQuestions']);
Route::post('/createquestion', [QuestionController::class,'storeQuestion']);


// test route 
Route::get('/generatequiz/{id}', [QuestionController::class, 'generateQuiz']);
// Route::post('startquiz', [QuestionController::class,'startQuiz']);
Route::post('/storequiz', [QuestionController::class,'storequiz']);  

Route::get('/testresult/{id}', [TestController::class,'getResult']);  
  
Route::get('/testcandidate', [TestController::class,'getTestCandidate']);    





