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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code');
            $table->enum('discount_type', ['amount', 'percentage']);
            $table->float('discount_amount')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->float('minimum')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('coupon_usage_limit')->nullable();
            $table->integer('coupon_usage_count')->default(0);

            $table->bigInteger('product_id')->unsigned()->nullable(); //if nullable the coupon will apply on all products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
           
            $table->bigInteger('user_id')->unsigned()->nullable(); //if nullable the coupon will apply on all users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('coupons');
    }
};
