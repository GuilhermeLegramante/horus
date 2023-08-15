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
            $table->integer('id', true);
            $table->integer('measurement_unit_id');
            $table->string('description')->unique();
            $table->string('code')->unique()->nullable();
            $table->string('barcode')->unique()->nullable();
            $table->double('weight')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->foreign('measurement_unit_id')
                ->references('id')
                ->on('measurement_units')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
