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

//Route::resource('estudantes', StudentController::class)->middleware(['auth','verified']);

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/estudantes', [StudentController::class, 'index'])->name('estudantes.index');
    Route::get('/estudantes/criar', [StudentController::class, 'create'])->name('estudantes.create');
    Route::post('/estudantes', [StudentController::class, 'store'])->name('estudantes.store');
    Route::get('/estudantes/{student:slug}', [StudentController::class, 'show'])->name('estudantes.show');
    Route::get('/estudantes/{student:slug}/editar', [StudentController::class, 'edit'])->name('estudantes.edit');
    Route::patch('/estudantes/{student}', [StudentController::class, 'update'])->name('estudantes.update');
    Route::delete('/estudantes/{student}', [StudentController::class, 'destroy'])->name('estudantes.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
