<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoCatalog extends Model
{
    use HasFactory;
    protected $fillable = ['catalog_id', 'filename','path'];
    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
