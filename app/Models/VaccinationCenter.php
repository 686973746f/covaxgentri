<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'site_province',
        'site_province_code',
        'time_start',
        'time_end',
        'is_mobile_vaccination',
        'notes',
    ];
}
