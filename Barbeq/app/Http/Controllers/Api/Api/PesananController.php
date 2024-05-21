<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    public function index()
    {
        $data = Pesanan::get()->all();
        return response()->json([
            'status'=>true,
            'message'=>'Data diterima',
            'data'=>$data

        ],200
        );
    }
    public function store(Request $request)
    {
        // dd($request->all());
        //data validation
        $request->validate([
            "kode" => "required",
            "produk_id" => "required",
            "pembeli_id" => "required",
            "penjual_id" => "required",
            "status_id" => "required",



        ]);
        //data save
        Pesanan::create([
            "kode" => $request->kode,
            "produk_id" => $request->produk_id,
            "pembeli_id" => $request->pembeli_id,
            "penjual_id" => $request->penjual_id,
            "status_id" => $request->status_id,


        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "Produk berhasil dibuat",

        ]);


    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        if (empty($pesanan)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],);

        }

        $rules = [
            "kode" => "required",
            "produk_id" => "required",
            "pembeli_id" => "required",
            "user_id" => "required",
            "status_id" => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message'=> 'gagal',
                'data' => $validator->errors()
            ]);
        }

        $pesanan->kode = $request->kode;


        // $post = $produk->save();


        return response()->json([
            'status'=> true,
            'message'=> 'sukses',

        ]);



    }


}
