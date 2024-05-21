<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

    class PesananController extends Controller
    {
        
        public function store(Request $request)
    {
        // dd($request->all());
        //data validation
        $request->validate([
            "kode" => "required",
            "produk_id" => "required",
            "pembeli_id" => "required",
            "alamat" => "required",
            "user_id" => "required",
            "butki_transfer" => "",
            "cara_bayar" => ""
            
        ]);
        
        Pesanan::create([
            "kode" => $request->kode,
            "produk_id" => $request->id,
            "pembeli_id" => $request->harga,
            "alamat" => $request->alamat,
            "user_id" => $request->id_user,
            "gambar" => $request->gambar,
            "bukti_transfer" => $request->bukti_transfer,
            "cara_bayar" => $request-> cara_bayar

        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "Pesanan berhasil dibuat"
        ]);


    }
    }
