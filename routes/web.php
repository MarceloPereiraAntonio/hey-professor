<?php

use App\Http\Controllers\{DashbordController, ProfileController, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(app()->isLocal()) {
        auth()->loginUsingId(11);

        return to_route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', DashbordController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
