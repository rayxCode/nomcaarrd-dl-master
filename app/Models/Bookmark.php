<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'catalog_id',
        'users_id',
        'editedBy',
    ];

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
