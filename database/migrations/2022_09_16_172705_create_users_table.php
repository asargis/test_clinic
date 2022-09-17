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
            $table->string('fio', 255);
            $table->string('job_title', 255);
            $table->string('phone', 11);
            $table->string('email', 255)->nullable();
            $table->enum('role', ['clinic', 'doctor', 'patient']);
            $table->bigInteger('clinic_id');
            $table->timestamps();
            $table->foreign('clinic_id')->references('id')->on('clinics');
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
