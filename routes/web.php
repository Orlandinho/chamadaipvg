<?php

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

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/alunos', [StudentController::class, 'index'])->name('alunos.index');
    Route::get('/alunos/criar', [StudentController::class, 'create'])->name('alunos.create');
    Route::post('/alunos', [StudentController::class, 'store'])->name('alunos.store');
    Route::get('/alunos/{student:slug}', [StudentController::class, 'show'])->name('alunos.show');
    Route::get('/alunos/{student:slug}/editar', [StudentController::class, 'edit'])->name('alunos.edit');
    Route::patch('/alunos/{student}', [StudentController::class, 'update'])->name('alunos.update');
    Route::delete('/alunos/{student}', [StudentController::class, 'destroy'])->name('alunos.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
