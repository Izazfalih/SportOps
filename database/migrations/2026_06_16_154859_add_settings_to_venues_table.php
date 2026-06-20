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
        Schema::table('venues', function (Blueprint $table) {
            $table->time('open_time')->default('08:00');
            $table->time('close_time')->default('23:00');
            $table->integer('dp_percentage')->default(50);
            $table->string('payment_expiry')->default('1_hour');
            $table->boolean('notif_new_booking')->default(true);
            $table->boolean('notif_payment')->default(true);
            $table->boolean('notif_cancel')->default(false);
            $table->string('merchant_name')->nullable()->default('SportOps Arena');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('venues', function (Blueprint $table) {
            $table->dropColumn([
                'open_time', 'close_time', 'dp_percentage', 'payment_expiry', 
                'notif_new_booking', 'notif_payment', 'notif_cancel', 'merchant_name'
            ]);
        });
    }
};
