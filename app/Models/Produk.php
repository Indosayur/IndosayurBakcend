<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'name', 'harga', 'deskripsi', 'kategori_id','gambar'
    ];
}
