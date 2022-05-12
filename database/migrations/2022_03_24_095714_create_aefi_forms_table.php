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
        Schema::create('aefi_forms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('patient_id')->nullable()->constrained()->onDelete('cascade');

            $table->text('vigiflow_id')->nullable();

            $table->text('p1_dru_name');
            $table->text('p1_dru_region');
            $table->text('p1_dru_province');
            $table->text('p1_dru_type');
            $table->text('p1_contactno');
            $table->text('p1_reporter_name');
            $table->text('p1_reporter_designation')->nullable();
            $table->text('p1_reporter_prc')->nullable();
            $table->text('p1_reporter_email')->nullable();

            $table->tinyInteger('p3_withpreviousreport_yn');
            $table->tinyInteger('p3_heterologous_yn');

            $table->tinyInteger('p4_chestpain_yn');
            $table->timestamp('p4_chestpain_onset_datetime')->nullable();
            $table->tinyInteger('p4_chills_yn');
            $table->timestamp('p4_chills_onset_datetime')->nullable();
            $table->tinyInteger('p4_colds_yn');
            $table->timestamp('p4_colds_onset_datetime')->nullable();
            $table->tinyInteger('p4_dizziness_yn');
            $table->timestamp('p4_dizziness_onset_datetime')->nullable();
            $table->tinyInteger('p4_feelingunwell_yn');
            $table->timestamp('p4_feelingunwell_onset_datetime')->nullable();
            $table->tinyInteger('p4_fever_yn');
            $table->timestamp('p4_fever_onset_datetime')->nullable();
            $table->tinyInteger('p4_headache_yn');
            $table->timestamp('p4_headache_onset_datetime')->nullable();
            $table->tinyInteger('p4_itching_yn');
            $table->timestamp('p4_itching_onset_datetime')->nullable();
            $table->tinyInteger('p4_jointpain_yn');
            $table->timestamp('p4_jointpain_onset_datetime')->nullable();
            $table->tinyInteger('p4_musclepain_yn');
            $table->timestamp('p4_musclepain_onset_datetime')->nullable();
            $table->tinyInteger('p4_nausea_yn');
            $table->timestamp('p4_nausea_onset_datetime')->nullable();
            $table->tinyInteger('p4_bodyrash_yn');
            $table->timestamp('p4_bodyrash_onset_datetime')->nullable();
            $table->tinyInteger('p4_tiredness_yn');
            $table->timestamp('p4_tiredness_onset_datetime')->nullable();
            $table->tinyInteger('p4_vaccinesitepain_yn');
            $table->timestamp('p4_vaccinesitepain_onset_datetime')->nullable();
            $table->tinyInteger('p4_vomiting_yn');
            $table->timestamp('p4_vomiting_onset_datetime')->nullable();
            $table->tinyInteger('p4_increasedbp_yn');
            $table->timestamp('p4_increasedbp_onset_datetime')->nullable();
            $table->text('p4_increasedbp_withhypertension_yn')->nullable();
            $table->integer('p4_pre_bp1')->nullable();
            $table->integer('p4_pre_bp2')->nullable();
            $table->integer('p4_post_bp1')->nullable();
            $table->integer('p4_post_bp2')->nullable();
            $table->text('p4_othersx1_details')->nullable();
            $table->timestamp('p4_othersx1_datetime')->nullable();
            $table->text('p4_othersx2_details')->nullable();
            $table->timestamp('p4_othersx2_datetime')->nullable();

            $table->text('p4_outcome');
            $table->text('p4_outcome_alive_type');
            $table->text('p4_outcome_alive_type_specify')->nullable();

            $table->text('p4_outcome_died_type')->nullable();
            $table->date('p4_outcome_died_date')->nullable();

            $table->date('p4_pm_dateconsult')->nullable();
            $table->text('p4_pm_type')->nullable();
            $table->date('p4_pm_datedischarged')->nullable();
            $table->date('p4_pm_admitted_date')->nullable();
            $table->text('p4_pm_admitted_diagnosis')->nullable();

            $table->tinyInteger('p4_seriouscase_yn');
            $table->text('p4_seriouscase_ifyes_type')->nullable();
            $table->text('p4_seriouscase_ifyes_other_specify')->nullable();

            $table->text('p5_phys_lname');
            $table->text('p5_phys_fname');
            $table->text('p5_phys_mname')->nullable();
            $table->text('p5_phys_contactno');
            $table->text('p5_phys_prc');
            $table->date('p5_phys_investigate_date');

            $table->text('p5_otherinfo_from_list')->nullable();
            $table->text('p5_otherinfo_from_list_specify')->nullable();
            $table->text('p5_otherinfo_lname')->nullable();
            $table->text('p5_otherinfo_fname')->nullable();
            $table->text('p5_otherinfo_mname')->nullable();
            $table->text('p5_otherinfo_contactno')->nullable();
            $table->text('p5_otherinfo_prc')->nullable();
            $table->text('p5_otherinfo_relationdesignation')->nullable();

            $table->text('p6_modeofexam_list')->nullable();
            $table->text('p6_modeofexam_other_specify')->nullable();
            $table->tinyInteger('p6_ifdied_autopsyrecommended')->nullable();
            $table->text('p6_ifdied_autopsynotdone_list')->nullable();
            $table->text('p6_ifdied_autopsynotdone_other_specify')->nullable();
            $table->text('p6_ifdied_verbalautopsy_name')->nullable();
            $table->text('p6_ifdied_verbalautopsy_relationship')->nullable();

            $table->text('p7_item1')->nullable();
            $table->text('p7_item2')->nullable();
            $table->text('p7_sxreview_support')->nullable();
            $table->text('p7_sxreview_notsupport')->nullable();
            $table->text('p7_medobhistory_support')->nullable();
            $table->text('p7_medobhistory_notsupport')->nullable();
            $table->text('p7_familyhistory_support')->nullable();
            $table->text('p7_familyhistory_notsupport')->nullable();
            $table->text('p7_personalhistory_support')->nullable();
            $table->text('p7_personalhistory_notsupport')->nullable();
            $table->text('p7_physicalexam_support')->nullable();
            $table->text('p7_physicalexam_notsupport')->nullable();

            $table->text('p7_item3')->nullable();

            $table->dateTime('p8_course_datetime1')->nullable();
            $table->text('p8_course_subjective_findings1')->nullable();
            $table->text('p8_course_objective_findings1')->nullable();
            $table->text('p8_course_assessment1')->nullable();
            $table->text('p8_course_managementdone1')->nullable();
            $table->dateTime('p8_course_datetime2')->nullable();
            $table->text('p8_course_subjective_findings2')->nullable();
            $table->text('p8_course_objective_findings2')->nullable();
            $table->text('p8_course_assessment2')->nullable();
            $table->text('p8_course_managementdone2')->nullable();
            $table->dateTime('p8_course_datetime3')->nullable();
            $table->text('p8_course_subjective_findings3')->nullable();
            $table->text('p8_course_objective_findings3')->nullable();
            $table->text('p8_course_assessment3')->nullable();
            $table->text('p8_course_managementdone3')->nullable();
            $table->dateTime('p8_course_datetime4')->nullable();
            $table->text('p8_course_subjective_findings4')->nullable();
            $table->text('p8_course_objective_findings4')->nullable();
            $table->text('p8_course_assessment4')->nullable();
            $table->text('p8_course_managementdone4')->nullable();

            $table->tinyInteger('p9_item1_yn')->nullable();
            $table->text('p9_item1_remarks')->nullable();
            $table->tinyInteger('p9_item2_yn')->nullable();
            $table->text('p9_item2_remarks')->nullable();
            $table->tinyInteger('p9_item3a_yn')->nullable();
            $table->text('p9_item3a_remarks')->nullable();
            $table->tinyInteger('p9_item3b_yn')->nullable();
            $table->text('p9_item3b_remarks')->nullable();
            $table->tinyInteger('p9_item4_yn')->nullable();
            $table->text('p9_item4_remarks')->nullable();
            $table->tinyInteger('p9_item5_yn')->nullable();
            $table->text('p9_item5_remarks')->nullable();
            $table->tinyInteger('p9_item6_yn')->nullable();
            $table->date('p9_item6_remarks')->nullable();
            $table->tinyInteger('p9_item7_yn')->nullable();
            $table->text('p9_item7_remarks')->nullable();
            $table->tinyInteger('p9_item8_yn')->nullable();
            $table->text('p9_item8_remarks')->nullable();
            $table->tinyInteger('p9_item9_yn')->nullable();
            $table->text('p9_item9_remarks')->nullable();

            $table->tinyInteger('p9_item10_yn')->nullable();
            $table->text('p9_item10_array1')->nullable();
            $table->text('p9_item10_array2')->nullable();
            $table->text('p9_item10_array3')->nullable();

            $table->text('p10_item1')->nullable();
            $table->text('p10_item2')->nullable();
            $table->tinyInteger('p10_item3_yn')->nullable();
            $table->text('p10_item3_remarks')->nullable();
            $table->text('p10_item4')->nullable();
            $table->tinyInteger('p10_item5_yn')->nullable();
            $table->text('p10_item5_remarks')->nullable();
            $table->text('p10_item6')->nullable();
            $table->text('p10_item7')->nullable();

            $table->text('p13_lname')->nullable();
            $table->text('p13_fname')->nullable();
            $table->text('p13_mname')->nullable();
            $table->text('p13_designation')->nullable();
            $table->text('p13_contactno')->nullable();
            $table->date('p13_investigation_date')->nullable();

            $table->text('p14_lname')->nullable();
            $table->text('p14_fname')->nullable();
            $table->text('p14_mname')->nullable();
            $table->text('p14_designation')->nullable();
            $table->text('p14_office')->nullable();
            
            $table->tinyInteger('autodisablesyringed_used_yn')->nullable();
            $table->text('autodisablesyringed_used_remarks')->nullable();
            $table->text('autodisablesyringed_used_ifno_type')->nullable();
            $table->text('autodisablesyringed_used_findings')->nullable();

            $table->text('reconstitution_method')->nullable();
            $table->text('reconstitution_method_others')->nullable();
            $table->tinyInteger('reconstitution_item1_yn')->nullable();
            $table->text('reconstitution_item1_remarks')->nullable();
            $table->tinyInteger('reconstitution_item2_yn')->nullable();
            $table->text('reconstitution_item2_remarks')->nullable();
            $table->tinyInteger('reconstitution_item3_yn')->nullable();
            $table->text('reconstitution_item3_remarks')->nullable();
            $table->tinyInteger('reconstitution_item4_yn')->nullable();
            $table->text('reconstitution_item4_remarks')->nullable();
            $table->tinyInteger('reconstitution_item5_yn')->nullable();
            $table->text('reconstitution_item5_remarks')->nullable();
            $table->text('reconstitution_findings')->nullable();

            $table->text('itechnique_method')->nullable();
            $table->tinyInteger('itechnique_item1_yn')->nullable();
            $table->text('itechnique_item1_remarks')->nullable();
            $table->text('itechnique_item2_time')->nullable();
            $table->text('itechnique_item2_remarks')->nullable();
            $table->tinyInteger('itechnique_item3_yn')->nullable();
            $table->text('itechnique_item3_remarks')->nullable();
            $table->tinyInteger('itechnique_item4_yn')->nullable();
            $table->text('itechnique_item4_remarks')->nullable();
            $table->text('itechnique_item5')->nullable();
            $table->text('itechnique_item5_remarks')->nullable();
            $table->text('itechnique_findings')->nullable();

            $table->text('p15_method')->nullable();
            $table->text('p15_method_others')->nullable();
            $table->text('p15_item1')->nullable();
            $table->text('p15_item1_others')->nullable();
            $table->text('p15_item2')->nullable();

            $table->tinyInteger('p15_item3_yn')->nullable();
            $table->text('p15_item3_remarks')->nullable();
            $table->tinyInteger('p15_item4_yn')->nullable();
            $table->text('p15_item4_remarks')->nullable();
            $table->tinyInteger('p15_item5_yn')->nullable();
            $table->text('p15_item5_remarks')->nullable();
            $table->tinyInteger('p15_item6_yn')->nullable();
            $table->text('p15_item6_selection')->nullable();
            $table->text('p15_item6_selection_others')->nullable();
            $table->text('p15_item6_remarks')->nullable();
            $table->tinyInteger('p15_item7_yn')->nullable();
            $table->text('p15_item7_selection')->nullable();
            $table->text('p15_item7_selection_others')->nullable();
            $table->text('p15_item7_remarks')->nullable();
            $table->text('p15_findings')->nullable();

            $table->text('p15_transpo_method')->nullable();
            $table->text('p15_transpo_item1')->nullable();
            $table->text('p15_transpo_item1_others')->nullable();
            $table->tinyInteger('p15_transpo_item2_yn')->nullable();
            $table->text('p15_transpo_item2_remarks')->nullable();
            $table->tinyInteger('p15_transpo_item3_yn')->nullable();
            $table->text('p15_transpo_item3_remarks')->nullable();
            $table->tinyInteger('p15_transpo_item4_yn')->nullable();
            $table->text('p15_transpo_item4_remarks')->nullable();
            $table->text('p15_transpo_findings')->nullable();

            $table->text('p16_lname')->nullable();
            $table->text('p16_fname')->nullable();
            $table->text('p16_mname')->nullable();
            $table->text('p16_designation')->nullable();
            $table->text('p16_office')->nullable();

            $table->text('p16_vaccinegiven_array')->nullable();
            $table->text('p16_totaldoses_array')->nullable();

            $table->text('p16_when1')->nullable();
            $table->text('p16_when2')->nullable();

            $table->tinyInteger('p16_item1_yn')->nullable();
            $table->text('p16_item1_remarks')->nullable();
            $table->tinyInteger('p16_item2_yn')->nullable();
            $table->text('p16_item2_remarks')->nullable();
            $table->tinyInteger('p16_item3_yn')->nullable();
            $table->text('p16_item3_remarks')->nullable();
            $table->tinyInteger('p16_item4_yn')->nullable();
            $table->text('p16_item4_remarks')->nullable();
            $table->tinyInteger('p16_item5_yn')->nullable();
            $table->text('p16_item5_remarks')->nullable();
            $table->tinyInteger('p16_item6_yn')->nullable();
            $table->text('p16_item6_remarks')->nullable();
            $table->tinyInteger('p16_item7_yn')->nullable();
            $table->text('p16_item7_remarks')->nullable();
            $table->tinyInteger('p16_item8_yn')->nullable();
            $table->text('p16_item8_remarks')->nullable();
            $table->tinyInteger('p16_item9_yn')->nullable();
            $table->text('p16_item9_remarks')->nullable();
            $table->tinyInteger('p16_item10_yn')->nullable();
            $table->text('p16_item10_remarks')->nullable();
            $table->tinyInteger('p16_item11_yn')->nullable();
            $table->text('p16_item11_remarks')->nullable();
            $table->tinyInteger('p16_item11_datanotgatheredinlvoc')->nullable();
            $table->tinyInteger('p16_item12_yn')->nullable();
            $table->text('p16_item12_numofclusteredcases')->nullable();
            $table->tinyInteger('p16_item12_cluster_yn')->nullable();
            $table->text('p16_item12_cluster_ifno_numofvials')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aefi_forms');
    }
};
