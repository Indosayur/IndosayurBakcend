<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller {
    public function store (Request $Request){
        $validasi = Validator::make($Request->all(),[
            'user_id' => 'required',
            'total_item' => 'required',
            'total_harga' => 'required',
            'name' => 'required',
            'jasa_pengiriman' => 'required',
            'total_transfer' => 'required',
            'ongkir' => 'required',
            'ongkir' => 'required',
            'bank' => 'required'
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->error($val[0]);
        }

        $kode_payment = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_trx = "INV/PYM/" . now()->format('Y-m-d') . "/" . rand(100, 999);
        $kode_unik = rand(100, 999);
        $status = "MENUNGGU";
        $expired_at = now()->addDay();

        $dataTransaksi = array_merge($Request->all(), [
            'kode_payment' => $kode_payment,
            'kode_trx' => $kode_trx,
            'kode_unik' => $kode_unik,
            'status' => $status,
            'expired_at' => $expired_at
        ]);

        \DB::beginTransaction();
        $transaksi = Transaksi::create($dataTransaksi);
        foreach ($Request->produks as $produk)  {
            $detail= [
                'transaksi_id' => $transaksi->id,
                'produk_id'=>$produk['id'],
                'total_item'=>$produk['total_item'],
                'catatan'=>$produk['catatan'],
                'total_harga'=>$produk['total_harga']
            ];
            $transaksiDetail = TransaksiDetail::create($detail);
        }

        if (!empty($transaksi) && !empty($transaksiDetail)) {
            \DB::commit();
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'Transaksi' => collect($transaksi)
            ]);
        } else {
            \DB::rollback();
            return $this->error('Transaksi gagal');
        }
    }

    public function history($id){

        $transaksis = Transaksi::with(['user'])->whereHas('user', function ($query)use($id){
            $query->whereId($id);
        })->get();

        foreach ($transaksis as $transaksi){
            $details = $transaksi->details;
            foreach ($details as $detail){
                $detail->produk;
            }
        }

        if (!empty($transaksis)) {
            return response()->json([
                'success' => 1,
                'message' => 'Transaksi Berhasil',
                'Transaksis' => collect($transaksis)
            ]);
        } else {
            return $this->error('Transaksi gagal');
        }

    }

    public function error($pesan){
        return response()->json([
            'success' => 0,
            'message' => $pesan
        ]);
    }
}
