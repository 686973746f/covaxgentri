<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineList extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_name',
        'default_batchno',
        'default_lotno',
        'expiration_date',
        'if_firstdose_nextdosedays',
        'is_singledose',
    ];
}
