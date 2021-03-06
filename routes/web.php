<?php

use App\Http\Controllers\Conference\LectureController;
use App\Http\Controllers\Conference\ParticipantController;
use App\Http\Controllers\Conference\ConferenceController;
use App\Http\Controllers\HomeController;
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


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('lecture/{id}', [LectureController::class, 'show'])->name('conference.lectures.show');
Route::get('conference/{conferenceId}', [ConferenceController::class, 'show'])->name('conference.show');
Route::get('conference/{conferenceId}/participants', [ParticipantController::class, 'index'])->name('conference.participants.index');
Route::get('conference/{conferenceId}/participants/create', [ParticipantController::class, 'create'])->name('conference.participants.create');
Route::post('conference/{conferenceId}/participants/store', [ParticipantController::class, 'store'])->name('conference.participants.store');
