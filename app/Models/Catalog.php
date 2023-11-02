<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $primaryKey = 'catalog_id';

    protected $fillable = [
        'title',
        'description',
        'publishedDate',
        'type_id',
        'fileURL',
        'photo_path',
        'status',
        'editedBy',
        'author_id', // Added author_id
        'comment_id', // Added comment_id
        'rating',
    ];

    // Relationships
    public function type()
    {
        return $this->belongsTo(CatalogType::class, 'type_id');
    }

    public function author()
    {
        return $this->hasMany(Author::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }
}
