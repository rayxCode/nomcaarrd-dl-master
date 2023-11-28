<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'firstname',
        'middlename',
        'lastname',
        'password',
        'affiliation_id',
        'photo_path',
        'access_level'
    ];
    protected $guarded = ['password', 'email'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
     /**
     * The attributes that should be guarded.
     *
     * @var array<int, string>
     */
     // Add other columns as needed


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function affiliation()
    {
        return $this->hasOne(Affiliation::class, 'affiliation_id');
    }
}
