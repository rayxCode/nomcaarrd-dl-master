<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'users_id',
        'catalog_id',
        'editedBy',
    ];

    // Relationships
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function catalogs()
    {
        return $this->belongsTo(Catalog::class, 'id');
    }
}
