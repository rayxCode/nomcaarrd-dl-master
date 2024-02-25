<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;

    protected $table = "tbl_users";

    protected $fillable = [
        'access',
        'email',
        'password',
        'username',
        'firstname',
        'middlename',
        'lastname',
        'affiliation_id',
        'status',
        'verified_email_at',
        'photo_path',
        'edited_by',
    ];

    public function affiliation()
    {
        return $this->belongsTo(Affiliation::class);
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
