<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;

    protected $table = "tbl_categories";

    protected $fillable = ['name', 'description', 'color_code'];

    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
