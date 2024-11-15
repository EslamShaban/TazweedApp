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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['original','high-copy', 'copy']);
            $table->string('manufacturing_year');
            $table->double('price')->default(0);
            $table->boolean('is_offer')->default(0);
            $table->double('discount_price')->nullable()->default(0);
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('car_type_id')->unsigned()->nullable();
            $table->foreign('car_type_id')->references('id')->on('car_types')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('manufacture_country')->unsigned()->nullable();
            $table->foreign('manufacture_country')->references('id')->on('countries')->onDelete('cascade')->onUpdate('cascade');
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
};
