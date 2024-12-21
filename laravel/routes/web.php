<?php

use App\Http\Controllers\IAMUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/awsiamusers', [IAMUserController::class, 'listUsers'])->name('awsiamusers.list');
    Route::post('/create-iam-user', [IAMUserController::class, 'storeUser'])->name('awsiamuser.store');
    Route::get('/awsiamuser/details', [IAMUserController::class, 'showUserDetails'])->name('awsiamuser.details');

});

require __DIR__.'/auth.php';
