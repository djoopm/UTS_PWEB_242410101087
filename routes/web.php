<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'showLogin'])->name('login');
Route::post('/login', [PageController::class, 'login'])->name('login.post'); // ← Tambahkan ini
Route::get('/dashboard', [PageController::class, 'showDashboard'])->name('dashboard');
Route::get('/pengelolaan', [PageController::class, 'showPengelolaan'])->name('pengelolaan');
Route::get('/profile', [PageController::class, 'showProfile'])->name('profile');
Route::post('/logout', [PageController::class, 'logout'])->name('logout');

// Route AJAX untuk pengelolaan buku
Route::put('/books/update', [PageController::class, 'updateBook']);
Route::delete('/books/delete', [PageController::class, 'deleteBook']);
Route::post('/books/add', [PageController::class, 'addBook']);