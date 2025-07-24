<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::post('/reservations', function (Request $request) {
    // 本来はバリデーション・DB保存
    Log::info('予約内容:', $request->all());

    return response()->json(['message' => '予約受け付けました']);
});
Route::get('/reservations', [ReservationController::class, 'index']);
