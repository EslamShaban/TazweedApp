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
        Schema::create('captain_requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('captain_id')->unsigned();
            $table->foreign('captain_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('wash_request_id')->unsigned();
            $table->foreign('wash_request_id')->references('id')->on('wash_requests')->onDelete('cascade')->onUpdate('cascade');
            $table->string('arrival_time');
            $table->enum('status', ['0', '1', '2', '3'])->default('0');
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
        Schema::dropIfExists('captain_requests');
    }
};
