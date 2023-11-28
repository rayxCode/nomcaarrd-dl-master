<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;

    protected $primaryKey = 'affiliation_id';

    protected $fillable = [
        'name',
        'editedBy',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'affiliation_id');
    }
}
