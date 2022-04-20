<?php

namespace App\Models;

use App\Models\User;
use App\Models\VaccineList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VaccinationSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccinelist_id',
        'for_date',
        'sched_type',
        'is_active',
        'is_adult',
        'is_pedia',
        'sched_timestart',
        'sched_timeend',
        'max_slots',
        'vaccination_center_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vaccinelist() {
        return $this->belongsTo(VaccineList::class, 'vaccinelist_id');
    }
}
