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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();        

            //prices
            $table->double('service_price')->nullable();
            $table->double('delivery_price')->nullable();
            $table->double('tax')->nullable();

            //contact
            $table->text('email')->nullable();
            $table->string('phone')->nullable();

            //social
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('youtube')->nullable();

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
        Schema::dropIfExists('settings');
    }
};
