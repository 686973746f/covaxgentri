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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('registration_type')->default('registration');

            $table->tinyInteger('is_approved');
            $table->timestamp('date_processed')->nullable();
            $table->text('action_remarks')->nullable();
            $table->text('qr_id')->nullable();
            $table->text('unique_person_id')->nullable();

            $table->string('editprofile_status')->default('ok');
            $table->text('editprofile_patient_remarks')->nullable();
            $table->timestamp('editprofile_date_processed')->nullable();
            $table->foreignId('editprofile_approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('editprofile_admin_remarks')->nullable();

            $table->string('username');
            $table->string('password');

            $table->text('lname');
            $table->text('fname');
            $table->text('mname')->nullable();
            $table->text('suffix')->nullable();
            $table->date('bdate');
            $table->string('sex');
            $table->tinyInteger('if_female_pregnant');
            $table->tinyInteger('if_female_lactating');
            $table->string('cs');
            $table->text('philhealth')->nullable();
            $table->text('nationality');
            $table->string('priority_group');
            $table->text('priority_specify')->nullable();
            $table->text('address_region_code');
            $table->text('address_region_text');
            $table->text('address_province_code');
            $table->text('address_province_text');
            $table->text('address_muncity_code');
            $table->text('address_muncity_text');
            $table->text('address_brgy_code');
            $table->text('address_brgy_text');
            $table->text('address_street');
            $table->text('address_houseno');

            $table->text('contactno');
            $table->text('email')->nullable();

            $table->tinyInteger('is_pwd');
            $table->tinyInteger('is_indigenous');

            $table->tinyInteger('is_singledose')->default(0);

            $table->tinyInteger('firstdose_from_system')->nullable();
            $table->foreignId('firstdose_schedule_id')->nullable()->references('id')->on('vaccination_schedules')->onDelete('cascade');
            $table->timestamp('firstdose_schedule_date_by_user')->nullable();
            $table->tinyInteger('firstdose_is_deferred')->nullable();
            $table->text('firstdose_deferred_reason')->nullable();
            $table->timestamp('firstdose_deferred_date')->nullable();
            $table->tinyInteger('firstdose_is_attended')->default(0);
            $table->date('firstdose_original_date')->nullable();
            $table->timestamp('firstdose_date')->nullable();
            $table->tinyInteger('firstdose_is_local')->default(1);
            $table->text('firstdose_location')->nullable();
            $table->text('firstdose_site_injection')->nullable();
            $table->foreignId('firstdose_vaccine_id')->nullable()->references('id')->on('vaccine_lists')->onDelete('cascade');
            $table->text('firstdose_name')->nullable();
            $table->text('firstdose_batchno')->nullable();
            $table->text('firstdose_lotno')->nullable();
            $table->text('firstdose_adverse_events')->nullable();
            $table->text('firstdose_vaccinator_name')->nullable();

            $table->tinyInteger('seconddose_from_system')->nullable();
            $table->foreignId('seconddose_schedule_id')->nullable()->references('id')->on('vaccination_schedules')->onDelete('cascade');
            $table->timestamp('seconddose_schedule_date_by_user')->nullable();
            $table->tinyInteger('seconddose_is_deferred')->nullable();
            $table->text('seconddose_deferred_reason')->nullable();
            $table->timestamp('seconddose_deferred_date')->nullable();
            $table->tinyInteger('seconddose_is_attended')->default(0);
            $table->date('seconddose_original_date')->nullable();
            $table->timestamp('seconddose_date')->nullable();
            $table->tinyInteger('seconddose_is_local')->default(1);
            $table->text('seconddose_location')->nullable();
            $table->text('seconddose_site_injection')->nullable();
            $table->foreignId('seconddose_vaccine_id')->nullable()->references('id')->on('vaccine_lists')->onDelete('cascade');
            $table->text('seconddose_name')->nullable();
            $table->text('seconddose_batchno')->nullable();
            $table->text('seconddose_lotno')->nullable();
            $table->text('seconddose_adverse_events')->nullable();
            $table->text('seconddose_vaccinator_name')->nullable();

            $table->tinyInteger('booster_from_system')->nullable();
            $table->foreignId('booster_schedule_id')->nullable()->references('id')->on('vaccination_schedules')->onDelete('cascade');
            $table->date('booster_schedule_date_by_user')->nullable();
            $table->tinyInteger('booster_is_deferred')->nullable();
            $table->text('booster_deferred_reason')->nullable();
            $table->timestamp('booster_deferred_date')->nullable();
            $table->tinyInteger('booster_is_attended')->default(0);
            $table->date('booster_original_date')->nullable();
            $table->tinyInteger('booster_is_local')->default(1);
            $table->timestamp('booster_date')->nullable();
            $table->text('booster_location')->nullable();
            $table->text('booster_site_injection')->nullable();
            $table->foreignId('booster_vaccine_id')->nullable()->references('id')->on('vaccine_lists')->onDelete('cascade');
            $table->text('booster_name')->nullable();
            $table->text('booster_batchno')->nullable();
            $table->text('booster_lotno')->nullable();
            $table->text('booster_adverse_events')->nullable();
            $table->text('booster_vaccinator_name')->nullable();

            $table->tinyInteger('boostertwo_from_system')->nullable();
            $table->foreignId('boostertwo_schedule_id')->nullable()->references('id')->on('vaccination_schedules')->onDelete('cascade');
            $table->date('boostertwo_schedule_date_by_user')->nullable();
            $table->tinyInteger('boostertwo_is_deferred')->nullable();
            $table->text('boostertwo_deferred_reason')->nullable();
            $table->timestamp('boostertwo_deferred_date')->nullable();
            $table->tinyInteger('boostertwo_is_attended')->default(0);
            $table->date('boostertwo_original_date')->nullable();
            $table->tinyInteger('boostertwo_is_local')->default(1);
            $table->timestamp('boostertwo_date')->nullable();
            $table->text('boostertwo_location')->nullable();
            $table->text('boostertwo_site_injection')->nullable();
            $table->foreignId('boostertwo_vaccine_id')->nullable()->references('id')->on('vaccine_lists')->onDelete('cascade');
            $table->text('boostertwo_name')->nullable();
            $table->text('boostertwo_batchno')->nullable();
            $table->text('boostertwo_lotno')->nullable();
            $table->text('boostertwo_adverse_events')->nullable();
            $table->text('boostertwo_vaccinator_name')->nullable();

            $table->text('comorbid_list')->nullable();
            $table->text('comorbid_others')->nullable();
            $table->text('allergy_list')->nullable();

            $table->text('requirement_id_filepath')->nullable();
            $table->text('requirement_selfie')->nullable();

            $table->string('ifpedia_guardian_lname')->nullable();
            $table->string('ifpedia_guardian_fname')->nullable();
            $table->string('ifpedia_guardian_mname')->nullable();
            $table->string('ifpedia_guardian_suffix')->nullable();

            $table->text('ifpedia_requirements')->nullable();

            $table->string('outcome')->default('Alive');
            $table->date('outcome_date')->nullable();

            $table->text('remarks')->nullable();

            $table->ipAddress('ipadd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
