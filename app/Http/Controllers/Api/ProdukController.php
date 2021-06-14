<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index(){
        // dd($Request->all());die();
        $produk = Produk::all();       
        return response()->json([
            'success' => 1,
            'message' => 'Get Produk Berhasil',
            'produk' => $produk
        ]);
    }
}
