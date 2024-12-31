<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Middleware\EnsureUserIsLoggedIn;
use App\Http\Middleware\EnsureUserIsAdmin;



Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.post');

Route::middleware([EnsureUserIsLoggedIn::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });
    Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard.index');

    Route::middleware([EnsureUserIsAdmin::class])->group(function () {

    Route::get('/dashboard/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/dashboard/store',[BookController::class,'store'])->name('book.store');
    Route::post('/dashboard', [BookController::class, 'index'])->name('dashboard.index');
    Route::delete('/dashboard/delete/{id}', [BookController::class, 'delete'])->name('book.destroy');
    Route::put('dahsboard/{id}', [BookController::class, 'update'])->name('book.update');
    Route::get('dahsboard/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
    Route::get('dahsboard/search', [BookController::class, 'search'])->name('book.search');

    Route::get('/rekap', [RekapController::class, 'index']);
});

});



