<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driverroute extends Model
{
    protected $fillable = [
        'driverid',
        'routeid',
        'price',
        'capacity',
        'offered',
    ];
}
