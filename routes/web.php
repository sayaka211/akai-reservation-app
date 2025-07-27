<?php

use App\Http\Controllers\ReservationController;
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

// 予約一覧画面（管理用）
Route::get('/admin/reservations', function () {
    return Inertia::render('Admin/ReservationList');
});
// 予約フォーム画面
Route::get('/reserve/create', function () {
    return Inertia::render('ReserveForm');
});
Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');
