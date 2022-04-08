<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_approved',
        'qr_id',
        'unique_person_id',
        'username',
        'password',
        'lname',
        'fname',
        'mname',
        'suffix',
        'bdate',
        'sex',
        'if_female_pregnant',
        'if_female_lactating',
        'cs',
        'philhealth',
        'nationality',
        'priority_group',
        'priority_specify',
        'address_region_code',
        'address_region_text',
        'address_province_code',
        'address_province_text',
        'address_muncity_code',
        'address_muncity_text',
        'address_brgy_code',
        'address_brgy_text',
        'address_street',
        'address_houseno',
        'contactno',
        'email',
        'is_pwd',
        'is_indigenous',
        'firstdose_schedule_id',
        'firstdose_schedule_date_by_user',
        'firstdose_is_deferred',
        'firstdose_deferred_reason',
        'firstdose_deferred_date',
        'firstdose_is_attended',
        'firstdose_original_date',
        'firstdose_date',
        'firstdose_is_local',
        'firstdose_location',
        'firstdose_site_injection',
        'firstdose_name',
        'firstdose_batchno',
        'firstdose_lotno',
        'firstdose_adverse_events',
        'firstdose_vaccinator_name',

        'seconddose_schedule_id',
        'seconddose_schedule_date_by_user',
        'seconddose_is_deferred',
        'seconddose_deferred_reason',
        'seconddose_deferred_date',
        'seconddose_is_attended',
        'seconddose_original_date',
        'seconddose_date',
        'seconddose_is_local',
        'seconddose_location',
        'seconddose_site_injection',
        'seconddose_name',
        'seconddose_batchno',
        'seconddose_lotno',
        'seconddose_adverse_events',
        'seconddose_vaccinator_name',

        'booster_schedule_id',
        'booster_schedule_date_by_user',
        'booster_is_deferred',
        'booster_deferred_reason',
        'booster_deferred_date',
        'booster_is_attended',
        'booster_original_date',
        'booster_is_local',
        'booster_date',
        'booster_location',
        'booster_site_injection',
        'booster_name',
        'booster_batchno',
        'booster_lotno',
        'booster_adverse_events',
        'booster_vaccinator_name',

        'comorbid_list',
        'allergy_list',
        'requirement_id_filepath',
        'requirement_selfie',

        'ifpedia_guardian_lname',
        'ifpedia_guardian_fname',
        'ifpedia_guardian_mname',

        'ifpedia_requirements',
        'remarks',
        'ipadd',
    ];

    public function getName() {
        return $this->lname.", ".$this->fname.' '.$this->suffix." ".$this->mname;
    }

    public function getAddress() {
        return $this->address_houseno.', '.$this->address_street.', BRGY. '.$this->address_brgy_text.', '.$this->address_citymun_text.', '.$this->address_province_text;
    }

    public function getAge() {
        if(Carbon::parse($this->attributes['bdate'])->age > 0) {
            return Carbon::parse($this->attributes['bdate'])->age;
        }
        else {
            if (Carbon::parse($this->attributes['bdate'])->diff(\Carbon\Carbon::now())->format('%m') == 0) {
                return Carbon::parse($this->attributes['bdate'])->diff(\Carbon\Carbon::now())->format('%d DAYS');
            }
            else {
                return Carbon::parse($this->attributes['bdate'])->diff(\Carbon\Carbon::now())->format('%m MOS');
            }
        }
    }

    public function getAgeInt() {
        return Carbon::parse($this->attributes['bdate'])->age;
    }
}