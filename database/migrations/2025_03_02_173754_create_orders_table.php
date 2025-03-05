<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->integer('user_id');
            $table->string('order_code');
            $table->string('color')->nullable();
            $table->integer('pieces')->nullable();
            $table->string('weight')->nullable();
            $table->string('size')->nullable();
            $table->enum('status', ['processing', 'cancelled', 'delivered', 'pending', 'placed'])->default('placed');
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
        Schema::dropIfExists('orders');
    }
}
