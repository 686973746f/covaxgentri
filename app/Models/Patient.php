<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\VaccineList;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Notifiable;

    public function username() {
        return 'username';
    }

    protected $fillable = [
        'is_approved',
        'date_processed',
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
        'is_singledose',

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
        'firstdose_vaccine_id',
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
        'seconddose_vaccine_id',
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
        'booster_vaccine_id',
        'booster_name',
        'booster_batchno',
        'booster_lotno',
        'booster_adverse_events',
        'booster_vaccinator_name',

        'boostertwo_schedule_id',
        'boostertwo_schedule_date_by_user',
        'boostertwo_is_deferred',
        'boostertwo_deferred_reason',
        'boostertwo_deferred_date',
        'boostertwo_is_attended',
        'boostertwo_original_date',
        'boostertwo_is_local',
        'boostertwo_date',
        'boostertwo_location',
        'boostertwo_site_injection',
        'boostertwo_vaccine_id',
        'boostertwo_name',
        'boostertwo_batchno',
        'boostertwo_lotno',
        'boostertwo_adverse_events',
        'boostertwo_vaccinator_name',

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

    public function getCurrentDose() {
        if($this->boostertwo_is_attended == 1) {
            return 4;
        }
        else if($this->booster_is_attended == 1) {
            return 3;
        }
        else if($this->seconddose_is_attended == 1) {
            return 2;
        }
        else if($this->firstdose_is_attended == 1) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function getCurrentDoseDate() {
        if($this->boostertwo_is_attended == 1) {
            return $this->boostertwo_date;
        }
        else if($this->booster_is_attended == 1) {
            return $this->booster_date;
        }
        else if($this->seconddose_is_attended == 1) {
            return $this->seconddose_date;
        }
        else if($this->firstdose_is_attended == 1) {
            return $this->firstdose_date;
        }
        else {
            return NULL;
        }
    }

    public function getFirstBakunaDetails() {
        $data = VaccineList::findOrFail($this->firstdose_vaccine_id);
        return $data;
    }

    public function getNextBakuna() {
        if($this->boostertwo_is_attended == 1) {
            return 'FINISHED';
        }
        else if($this->booster_is_attended == 1) {
            return 'BOOSTER2';
        }
        else if($this->seconddose_is_attended == 1) {
            return 'BOOSTER';
        }
        else if($this->firstdose_is_attended == 1) {
            if ($this->is_singledose == 1) {
                return 'BOOSTER';
            }
            else {
                return '2ND DOSE';
            }
        }
        else {
            return '1ST DOSE';
        }
    }

    public function ifHasPendingSchedule() {
        if($this->getNextBakuna() == '1ST DOSE') {
            if(!is_null($this->firstdose_schedule_id) && is_null($this->firstdose_date)) {
                return true;
            }
        }
        else if($this->getNextBakuna() == '2ND DOSE') {
            if(!is_null($this->seconddose_schedule_id) && is_null($this->seconddose_date)) {
                return true;
            }
        }
        else if($this->getNextBakuna() == 'BOOSTER') {
            if(!is_null($this->booster_schedule_id) && is_null($this->booster_date)) {
                return true;
            }
        }
        else if($this->getNextBakuna() == 'BOOSTER2') {
            if(!is_null($this->boostertwo_vaccine_id) && is_null($this->boostertwo_date)) {
                return true;
            }
        }
    }

    public function ifNextDoseReady() {
        if($this->getNextBakuna() == '1ST DOSE') {
            return true;
        }
        else if($this->getNextBakuna() == '2ND DOSE') {
            $vdata = VaccineList::findOrFail($this->firstdose_vaccine_id);

            $sdate = date('Y-m-d', strtotime($this->firstdose_date));

            $diffInDays = Carbon::parse($sdate)->diffInDays(Carbon::now());
            $daysToCompare = $vdata->seconddose_nextdosedays;
        }
        else if($this->getNextBakuna() == 'BOOSTER') {
            if($this->is_singledose == 1) {
                $sdate = date('Y-m-d', strtotime($this->firstdose_date));
            }
            else {
                $sdate = date('Y-m-d', strtotime($this->seconddose_date));
            }
    
            $diffInDays = Carbon::parse($sdate)->diffInDays(Carbon::now());
    
            $daysToCompare = 90; //3 Months
        }
        else if($this->getNextBakuna() == 'BOOSTER2') {
            $sdate = date('Y-m-d', strtotime($this->booster_date));
            $diffInDays = Carbon::parse($sdate)->diffInDays(Carbon::now());
    
            $daysToCompare = 90; //3 Months
        }
        else if($this->getNextBakuna() == 'FINISHED') {
            return false;
        }
        
        if($diffInDays >= $daysToCompare) {
            return true;
        }
        else {
            return false;
        }
    }

    public function ifBoosterReady() {
        if($this->is_singledose == 1) {
            $sdate = date('Y-m-d', strtotime($this->firstdose_date));
        }
        else {
            $sdate = date('Y-m-d', strtotime($this->seconddose_date));
        }

        $diffInDays = Carbon::parse($sdate)->diffInDays(Carbon::now());

        if($diffInDays >= 90) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getCurrentSchedId() {
        if(!is_null($this->firstdose_schedule_id) && is_null($this->firstdose_date)) {
            return $this->firstdose_schedule_id;
        }
        else if(!is_null($this->seconddose_schedule_id) && is_null($this->seconddose_date)) {
            return $this->seconddose_schedule_id;
        }
        else if(!is_null($this->booster_schedule_id) && is_null($this->booster_date)) {
            return $this->booster_schedule_id;
        }
        else {
            return NULL;
        }
    }
}