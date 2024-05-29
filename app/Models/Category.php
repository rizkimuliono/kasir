<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_nama',
        'cat_deskripsi',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'pro_categori_id');
    }
}
