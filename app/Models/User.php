<?php

namespace App\Models;

use App\Models\VaccineList;
use App\Models\VaccinatorNames;
use App\Models\VaccinationCenter;
use Laravel\Sanctum\HasApiTokens;
use App\Models\VaccinationSchedule;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vaccinatorname() {
        return $this->hasMany(VaccinatorNames::class, 'created_by');
    }

    public function vaccinelist() {
        return $this->hasMany(VaccineList::class, 'created_by');
    }

    public function vaccinationcenter() {
        return $this->hasMany(VaccinationCenter::class, 'created_by');
    }

    public function vaccinationschedule() {
        return $this->hasMany(VaccinationSchedule::class, 'created_by');
    }
}
