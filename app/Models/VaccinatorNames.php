<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinatorNames extends Model
{
    use HasFactory;

    protected $fillable = [
        'lname',
        'fname',
        'mname',
        'suffix',
    ];
}
