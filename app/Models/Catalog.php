<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'harga', 'deskripsi', 'jenis_catalog_id'];
    
    public function fotos()
    {
        return $this->hasMany(FotoCatalog::class);
    }
}
