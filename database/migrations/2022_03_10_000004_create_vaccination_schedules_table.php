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
            $table->date('for_date');
            $table->text('sched_type'); //1st, 2nd dose, Booster
            $table->tinyInteger('is_active');
            $table->tinyInteger('is_adult');
            $table->tinyInteger('is_pedia');
            $table->time('sched_timestart');
            $table->time('sched_timeend');
            $table->integer('current_slots')->default(0);
            $table->integer('max_slots');
            $table->foreignId('vaccinelist_id')->constrained('vaccine_lists')->onDelete('cascade');
            $table->foreignId('vaccination_center_id')->constrained('vaccination_centers')->onDelete('cascade');

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
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
