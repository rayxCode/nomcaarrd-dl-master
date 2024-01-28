<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogType extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'editedBy',
    ];

    public function catalogs(){
        return $this->hasMany(Catalog::class);
    }
}
