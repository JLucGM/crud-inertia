<?php

use App\Http\Controllers\ContactController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//Route::resource('contact', ContactController::class);

Route::get('contact', [ContactController::class,'index'])->name('contact.index');
Route::get('contact/create', [ContactController::class,'create'])->name('contact.create');
Route::post('contact', [ContactController::class,'store'])->name('contact.store');
Route::get('contact/{contact}/edit', [ContactController::class,'edit'])->name('contact.edit');
Route::post('contact/{contact}', [ContactController::class,'update'])->name('contact.update');
Route::delete('contact/{contact}', [ContactController::class,'destroy'])->name('contact.destroy');