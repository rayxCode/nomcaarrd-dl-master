<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{

    protected $fillable = [
        'status',
        'catalog_id',
        'users_id',

        // Add other fields as needed
    ];

     // Relationships
     public function user()
     {
         return $this->belongsTo(User::class, 'users_id');
     }

     public function catalog()
     {
         return $this->belongsTo(Catalog::class, 'catalog_id');
     }
}
