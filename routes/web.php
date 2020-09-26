<?php

use App\Http\Controllers\Conference\LectureController;
use App\Http\Controllers\Conference\ParticipantController;
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

Route::get('lecture/{id}', [LectureController::class, 'show'])->name('conference.lecture');
Route::get('conference/{conferenceId}/participants', [ParticipantController::class, 'index'])->name('conference.participants');
