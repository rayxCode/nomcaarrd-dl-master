<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    use HasFactory;

    protected $table = "tbl_appointments";

    protected $fillable = [
        'name',
        'email',
        'time',
        'status',
    ];

    protected $casts = [
        'time' => 'date',
    ];
}
