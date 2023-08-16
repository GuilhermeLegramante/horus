<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsBalanceFakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fake_balance', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('description')->nullable();
            $table->integer('previous_balance')->nullable();
            $table->integer('inputs')->nullable();
            $table->integer('outputs')->nullable();
            $table->integer('current_stock')->nullable();
            $table->integer('sales')->nullable();
            $table->integer('manual_sales')->nullable();
            $table->integer('counter_balance')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('fake_balance');
    }
}
