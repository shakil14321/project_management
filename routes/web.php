<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;



Auth::routes([
    'register' => true,
]);




Route::get('/', function () {
    return view('form');
});


// Grouped project routes with auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/{id}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Route::get('/', [ProjectController::class, 'index'])->name('home');
    Route::post('/store', [ProjectController::class, 'store'])->name(name: 'form.submit');
    Route::get('/projects/{id}/profile', [ProjectController::class, 'show'])->name('projects.profile');
    Route::put('/projects/{id}/update', [ProjectController::class, 'update'])->name('projects.show');

});