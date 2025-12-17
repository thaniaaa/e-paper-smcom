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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('subscription_plan_id')->constrained()->onDelete('cascade');
        $table->integer('amount');                  // jumlah yang dibayar
        $table->string('status')->default('pending'); // pending, paid, failed, expired
        $table->string('payment_method')->nullable(); // manual, midtrans, dll
        $table->string('order_id')->nullable();       // kode unik dari gateway (jika pakai)
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
