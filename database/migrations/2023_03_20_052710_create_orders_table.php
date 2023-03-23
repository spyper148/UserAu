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
        Schema::create('orders', function (Blueprint $table)
        {

            $table->id();
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('work_shift_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_order_id');

            $table->timestamps();

            $table->foreign('table_id')->references('id')->on('tables');
            $table->foreign('work_shift_id')->references('id')->on('work_shifts');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_order_id')->references('id')->on('status_orders');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
