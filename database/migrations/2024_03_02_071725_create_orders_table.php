<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('payment_amount')->unsigned();
            // sub total
            $table->integer('sub_total')->unsigned();
            // tax
            $table->integer('tax')->unsigned();
            // discount
            $table->integer('discount')->unsigned();
            // total
            $table->integer('total')->unsigned();
            // payment method
            $table->string('payment_method');
            // total item
            $table->integer('total_item')->unsigned();
            // foregin to user id
            $table->foreignId('user_id')->constrained('users');
            // transaction time
            $table->dateTime('transaction_time');
            $table->timestamps();
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