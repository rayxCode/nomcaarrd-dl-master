<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'description',
        'publishedDate',
        'authors',
        'type_id',
        'fileURL',
        'photo_path',
        'status',
        'editedBy',
        'nUserRated',
        'author_id', // Added author_id
        'comment_id', // Added comment_id
        'rating',
    ];

    protected $casts = [
        'authors' => 'json',
    ];


    // Relationships
    public function types()
    {
        return $this->belongsTo(CatalogType::class, 'type_id');
    }

    public function authors()
    {
        return $this->hasMany(Author::class, 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id');
    }
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'catalog_id');
    }
}
