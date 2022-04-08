<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'sched_type',
        'is_active',
        'is_adult',
        'is_pedia',
        'sched_timestart',
        'sched_timeend',
        'max_slots',
        'vaccination_center_id',
    ];
}
