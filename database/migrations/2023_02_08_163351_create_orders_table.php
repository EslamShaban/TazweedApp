<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('shipping_address_id')->unsigned();
            $table->decimal('total_price' , 8 , 2)->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('discount' , 8 , 2)->nullable();
            $table->decimal('tax' , 8 , 2)->nullable();
            $table->enum('payment_type', ['cash', 'card'])->default('cash');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->onDelete('cascade')->onUpdate('cascade');
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
};
