<?php

namespace App;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'userid',
        'driverrouteid',
        'posterprice',
        'status',
        'requestdate',
        'startdate',
        'enddate',
    ];
}
