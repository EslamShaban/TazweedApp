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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->text('about')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('email')->nullable();
            $table->string('gmail')->nullable();
            $table->string('facebook')->nullable();
            $table->string('phone')->nullable();
            $table->string('code')->nullable();
            $table->boolean('email_verified')->default(0);
            $table->boolean('phone_verified')->default(0);
            $table->boolean('is_verified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fcm')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
