<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;


Auth::routes([
    'register' => true,
]);




Route::get('/', function () {
    return view('form');
});

// Route::post('/whatsapp', function (Request $request) {
//     $number = preg_replace('/[^0-9]/', '', $request->number);
//     return redirect("https://wa.me/{$number}");
// })->name('whatsapp.redirect');

// Route::post('/email', function () {
//     return redirect("https://mail.google.com");
// })->name('email.redirect');

// // Optional: Handle full form submit
// Route::post('/submit-full-form', function (Request $request) {
//     if ($request->hasFile('proposal')) {
//         $pdf = $request->file('proposal');
//         $pdf->storeAs('proposals', $pdf->getClientOriginalName(), 'public');
//     }

//     return back()->with('success', 'Form submitted successfully!');
// })->name('form.submit');

//Route::post('/', [ProjectController::class, 'store'])->name(name: 'form.submit');


// Grouped project routes with auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::post('/projects/{id}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/store', [ProjectController::class, 'store'])->name(name: 'form.submit');
    Route::get('/projects/{id}/profile', [ProjectController::class, 'show'])->name('projects.profile');
    Route::put('/projects/{id}/update', [ProjectController::class, 'update'])->name('projects.update');

});