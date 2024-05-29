<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pro_nama',
        'pro_deskripsi',
        'pro_stok',
        'pro_harga_beli',
        'pro_harga_jual',
        'pro_categori_id',
        'pro_gambar'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'pro_categori_id');
    }
}
