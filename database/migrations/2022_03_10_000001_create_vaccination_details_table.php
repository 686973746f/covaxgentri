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
        Schema::create('vaccination_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            /*
            $table->foreignId('patient_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->tinyInteger('dose_number');
            $table->text('vaccine_name');
            $table->text('vaccination_place');
            $table->dateTime('vaccination_date');
            $table->text('site_injection');
            $table->text('batch_lot_number');
            $table->date('expiry_date')->nullable();
            $table->text('vaccinationsite_name');
            $table->text('vaccinationsite_country');
            $table->text('vaccinationsite_region');
            $table->text('vaccinationsite_region_code');
            $table->text('vaccinationsite_province');
            $table->text('vaccinationsite_province_code');
            $table->text('vaccinationsite_citymun');
            $table->text('vaccinationsite_citymun_code');
            $table->text('vaccinationsite_brgy');
            $table->text('diluent')->nullable();
            $table->dateTime('reconstitution_datetime')->nullable();
            $table->text('diluent_batchno')->nullable();
            $table->date('diluent_expiration_date')->nullable();
            $table->text('procured_from');
            $table->text('procured_from_others_specify')->nullable();
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination_details');
    }
};
