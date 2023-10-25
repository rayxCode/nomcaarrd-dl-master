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
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class, 'catalog_id');
    }
}
