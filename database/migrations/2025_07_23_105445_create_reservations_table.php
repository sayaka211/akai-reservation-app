<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // 予約者名
            $table->string('email');                   // メールアドレス
            $table->string('phone');                   // 電話番号
            $table->date('date');                      // 利用日（例: 2025-07-25）
            $table->time('start_time');                // 開始時刻（例: 14:00）
            $table->time('end_time');                  // 終了時刻（例: 16:00）
            $table->text('notes')->nullable();         // 任意の備考
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
