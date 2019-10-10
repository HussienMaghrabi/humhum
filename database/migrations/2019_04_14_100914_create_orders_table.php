<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('order_number')->nullable();
            $table->enum('payment', [1,2])->default(1);
            $table->enum('status', [1,2,3])->default(1);
            $table->string('address')->nullable();
            $table->double('vat')->default(0);
            $table->double('cost')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
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
