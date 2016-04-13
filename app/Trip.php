<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'driverrouteid',
        'posterprice',
        'status',
        'requestdate',
        'startdate',
        'enddate',
    ];
}
