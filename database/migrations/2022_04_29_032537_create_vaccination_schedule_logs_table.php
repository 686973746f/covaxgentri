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
        Schema::create('vaccination_schedule_logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->foreignId('vaccination_schedule_id')->constrained('vaccination_schedules')->onDelete('cascade');
            $table->string('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination_schedule_logs');
    }
};
