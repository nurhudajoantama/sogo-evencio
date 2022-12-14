<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('product_id')->nullable()->references('id')->on('products')->nullOnDelete();
            $table->foreignId('service_id')->nullable()->references('id')->on('products')->nullOnDelete();
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_methods')->nullOnDelete();
            $table->foreignId('status_id')->references('id')->on('transaction_statuses');
            $table->unsignedBigInteger('total');
            $table->integer('destination');
            $table->string('detail_destination');
            $table->string('destination_name');
            $table->string('destination_phone');
            $table->string('shipment_method');
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
