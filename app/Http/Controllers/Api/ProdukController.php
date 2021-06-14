<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::all();
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'produk' => $produk
        ]);
    }
}
