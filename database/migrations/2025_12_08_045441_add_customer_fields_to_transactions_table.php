<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->string('customer_name')->nullable()->after('user_id');
        $table->string('phone')->nullable()->after('customer_name');
        $table->string('city')->nullable()->after('phone');
        // kolom payment_method sudah ada, jadi tidak perlu ditambah
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['customer_name', 'phone', 'city']);
    });
}

};
