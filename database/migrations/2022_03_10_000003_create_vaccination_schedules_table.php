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
        Schema::create('vaccination_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('sched_type'); //1st, 2nd dose, Booster
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_adult');
            $table->tinyInteger('is_pedia');
            $table->dateTime('sched_timestart');
            $table->dateTime('sched_timeend');
            $table->integer('max_slots');
            //$table->foreignId('vaccine_id')->constrained('vaccine_lists')->onDelete('cascade');
            $table->foreignId('vaccination_center_id')->constrained('vaccination_centers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination_schedules');
    }
};
