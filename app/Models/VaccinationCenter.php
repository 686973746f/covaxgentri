<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccinationCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_prefix',
        'name',
        'vaccinationsite_location',
        'vaccinationsite_country',
        'vaccinationsite_region',
        'vaccinationsite_region_code',
        'vaccinationsite_province',
        'vaccinationsite_province_code',
        'vaccinationsite_citymun',
        'vaccinationsite_citymun_code',
        'vaccinationsite_brgy',
        'vaccinationsite_brgy_code',
        'time_start',
        'time_end',
        'is_mobile_vaccination',
        'notes',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getAddress() {
        return 'BRGY. '.$this->vaccinationsite_brgy.', '.$this->vaccinationsite_citymun.', '.$this->vaccinationsite_province;
    }
}
