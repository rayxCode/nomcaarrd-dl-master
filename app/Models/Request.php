<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = "tbl_requests";

    protected $fillable = [
        'status',
        'expires_on',
        'document_id',
        'user_id',
    ];

    protected $dates = [
        'expires_on',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
