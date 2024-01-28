<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'docs';

    protected $fillable = [
        'title',
        'code',
        'description',
        'publishedDate',
        'authors',
        'publisher',
        'visibility',
        'type_id',
        'fileURL',
        'photo_path',
        'status',
        'editedBy',
        'nUserRated',
        'comment_id', // Added comment_id
        'rating',
        'view_count',
        'dl_count',
    ];

    protected $casts = [
        'authors' => 'json',
    ];


    // Relationships
    public function types()
    {
        return $this->belongsTo(CatalogType::class, 'type_id');
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
