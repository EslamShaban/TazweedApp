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
        Schema::create('address_type_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_type_id');
            $table->string('locale')->index();
            $table->string('type');
            $table->unique(['address_type_id', 'locale']);
            $table->foreign('address_type_id')->references('id')->on('address_types')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_type_translations');
    }
};
