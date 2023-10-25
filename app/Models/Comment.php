<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; // Specify the table name if it's different from the model name in plural form

    protected $primaryKey = 'comment_id'; // Specify the primary key if it's different from 'id'

    protected $fillable = [
        'users_id',
        'catalog_id',
        'editedBy',
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
