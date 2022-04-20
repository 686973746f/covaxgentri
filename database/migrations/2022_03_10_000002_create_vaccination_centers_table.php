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
        Schema::create('vaccination_centers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('card_prefix');
            $table->string('name');
            $table->string('vaccinationsite_location');
            $table->string('vaccinationsite_country');
            $table->string('vaccinationsite_region');
            $table->string('vaccinationsite_region_code');
            $table->string('vaccinationsite_province');
            $table->string('vaccinationsite_province_code');
            $table->string('vaccinationsite_citymun');
            $table->string('vaccinationsite_citymun_code');
            $table->string('vaccinationsite_brgy');
            $table->string('vaccinationsite_brgy_code');
            $table->time('time_start');
            $table->time('time_end');
            $table->tinyInteger('is_mobile_vaccination');
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('vaccination_centers');
    }
};
