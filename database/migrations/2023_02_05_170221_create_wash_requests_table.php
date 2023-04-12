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
        Schema::create('wash_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('captain_id')->unsigned()->nullable();
            $table->string('location');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->enum('status', ['created', 'waiting', 'approved', 'arrived', 'washing', 'finishing'])->default('created');
            $table->double('tip')->default(0);
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('captain_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('wash_requests');
    }
};
