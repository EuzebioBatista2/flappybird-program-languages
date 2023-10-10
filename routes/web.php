<?php

use App\Http\Controllers\RankController;
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/score', ScoreController::class);

Route::get('/score/user/{userId}', [ScoreController::class, 'showByUserId']);
Route::get('/rank', [RankController::class, 'showRank']);
Route::delete('/score/user/{userId}', [ScoreController::class, 'deleteByUserId']);
