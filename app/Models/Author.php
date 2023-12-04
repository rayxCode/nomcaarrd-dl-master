<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $primaryKey = 'author_id';

    protected $fillable = [
        'users_id',
        'catalog_id',
        'editedBy',
    ];

    // Relationships
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function catalogs()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }
}
