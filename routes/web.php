<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\Guru\DataSiswaController;
use App\Http\Controllers\Guru\DashboardDataController;

Route::get('/login/guru', [AuthController::class, 'showGuruLogin'])->name('guru.login');
Route::post('/login/guru', [AuthController::class, 'loginGuru'])->name('guru.login.process');
Route::get('/login/siswa', [AuthController::class, 'showSiswaLogin'])->name('siswa.login');
Route::post('/login/siswa', [AuthController::class, 'loginSiswa'])->name('siswa.login.process');

Route::get('/', function () {
    return redirect()->route('siswa.login');
});

Route::middleware(['auth', 'role:guru'])->group(function () {

    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/dashboard/data', [DashboardDataController::class, 'data'])->name('guru.dashboard.data');

    Route::get('/guru/data-siswa', [DataSiswaController::class, 'index'])->name('guru.data-siswa');
    Route::get('/guru/data-siswa/{siswa}/edit', [DataSiswaController::class, 'edit'])->name('guru.data-siswa.edit');
    Route::put('/guru/data-siswa/{siswa}', [DataSiswaController::class, 'update'])->name('guru.data-siswa.update');
    Route::delete('/guru/data-siswa/{siswa}', [DataSiswaController::class, 'destroy'])->name('guru.data-siswa.destroy');

    Route::get('/guru/ujian', [ExamController::class, 'index'])->name('guru.exams.index');
    Route::get('/guru/ujian/buat', [ExamController::class, 'create'])->name('guru.exams.create');
    Route::post('/guru/ujian', [ExamController::class, 'store'])->name('guru.exams.store');
    Route::get('/guru/ujian/{exam}', [ExamController::class, 'show'])->name('guru.exams.show');
    Route::get('/guru/ujian/{exam}/edit', [ExamController::class, 'edit'])->name('guru.exams.edit');
    Route::put('/guru/ujian/{exam}', [ExamController::class, 'update'])->name('guru.exams.update');
    Route::delete('/guru/ujian/{exam}', [ExamController::class, 'destroy'])->name('guru.exams.destroy');
    Route::post('/guru/ujian/{exam}/aktifkan', [ExamController::class, 'activate'])->name('guru.exams.activate');
    Route::post('/guru/ujian/{exam}/selesaikan', [ExamController::class, 'finish'])->name('guru.exams.finish');

    Route::get('/guru/hasil-ujian', [ExamResultController::class, 'examList'])->name('guru.results.index');
    Route::get('/guru/hasil-ujian/{exam}', [ExamResultController::class, 'index'])->name('guru.results.show');
    Route::get('/guru/hasil-ujian/{exam}/api', [ExamResultController::class, 'apiResults'])->name('guru.results.api');
    Route::post('/guru/hasil-ujian/{exam}/retake/{siswa}', [ExamResultController::class, 'approveRetake'])->name('guru.results.approve-retake');
    Route::get('/guru/ujian/{exam}/hasil', [ExamResultController::class, 'index'])->name('guru.exams.results');

    Route::get('/guru/ujian/{exam}/soal/tambah', [QuestionController::class, 'create'])->name('guru.questions.create');
    Route::post('/guru/ujian/{exam}/soal', [QuestionController::class, 'store'])->name('guru.questions.store');
    Route::get('/guru/ujian/{exam}/soal/{question}/edit', [QuestionController::class, 'edit'])->name('guru.questions.edit');
    Route::put('/guru/ujian/{exam}/soal/{question}', [QuestionController::class, 'update'])->name('guru.questions.update');
    Route::delete('/guru/ujian/{exam}/soal/{question}', [QuestionController::class, 'destroy'])->name('guru.questions.destroy');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::post('/siswa/ujian/masuk', [SiswaController::class, 'masukUjian'])->name('siswa.exam.join');
    Route::get('/siswa/ujian/{exam}', [SiswaController::class, 'exam'])->name('siswa.exam');
    Route::post('/siswa/ujian/{exam}/submit', [SiswaController::class, 'submit'])->name('siswa.exam.submit');
    Route::get('/siswa/ujian/{exam}/hasil', [SiswaController::class, 'result'])->name('siswa.exam.result');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/guru/hasil-ujian/{exam}/siswa/{siswa}/approve-retake', [ExamResultController::class, 'approveRetake'])->name('guru.results.approve-retake');