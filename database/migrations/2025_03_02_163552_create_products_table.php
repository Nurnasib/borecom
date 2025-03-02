<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('created_by');
            $table->bigInteger('price')->default(0);
            $table->bigInteger('delivery_charge')->default(0);
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('category_id');
            $table->string('category_name');
            $table->enum('required_advance',['deli', 'all', 'price', 'none'])->default('deli');
            $table->enum('status', ['active', 'inactive', 'out_of_stock', 'discontinued'])->default('active');
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
        Schema::dropIfExists('products');
    }
}
