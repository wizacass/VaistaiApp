<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmaceuticalNetwork extends Model
{
    protected $fillable = [
        'pavadinimas', 'salis', 'adresas',
    ];
}
