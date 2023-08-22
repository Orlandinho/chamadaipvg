<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(StudentController::class)
    ->middleware(['auth'])
    ->group(function () {
    Route::get('/alunos', 'index')->name('alunos.index');
    Route::get('/aluno/criar', 'create')->name('alunos.create');
    Route::post('/alunos', 'store')->name('alunos.store');
    Route::get('/aluno/{student:slug}', 'show')->name('alunos.show');
    Route::get('/aluno/{student:slug}/editar', 'edit')->name('alunos.edit');
    Route::patch('/alunos/{student}', 'update')->name('alunos.update');
    Route::delete('/alunos/{student}', 'destroy')->name('alunos.destroy');
});

Route::controller(ClassroomController::class)
    ->middleware(['auth'])
    ->group(function () {
    Route::get('/classes', 'index')->name('classes.index');
    Route::get('/classe/criar', 'create')->name('classes.create');
    Route::post('/classes', 'store')->name('classes.store');
    Route::get('/classe/{classroom:slug}', 'show')->name('classes.show');
    Route::get('/classe/{classroom:slug}/editar', 'edit')->name('classes.edit');
    Route::patch('/classe/{classroom}', 'update')->name('classes.update');
    Route::delete('/classe/{classroom}', 'destroy')->name('classes.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
