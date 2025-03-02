<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('transactionId')->nullable();
            $table->integer('user_id');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('delivery_charge')->default(0);
            $table->integer('paid')->default(0);
            $table->integer('due')->default(0);
            $table->enum('status', ['complete', 'pending', 'partial', 'failed'])->default('pending');
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
        Schema::dropIfExists('payments');
    }
}
