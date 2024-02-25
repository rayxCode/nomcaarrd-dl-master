<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "tbl_documents";

    protected $fillable = [
        'title',
        'visibility',
        'publisher',
        'description',
        'publishedDate',
        'category_id',
        'fileURL',
        'status',
        'rating',
        'nUserRated',
        'view_count',
        'dl_count',
        'photo_path',
        'remarks',
        'edited_by',
    ];

    protected $dates = [
        'publishedDate',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }

}
