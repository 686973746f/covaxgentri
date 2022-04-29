<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationScheduleLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'vaccination_schedule_id',
        'status',
    ];
}
