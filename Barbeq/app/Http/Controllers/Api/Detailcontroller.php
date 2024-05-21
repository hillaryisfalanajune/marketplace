<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProdukController as ControllersProdukController;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Detailcontroller extends Controller
{
    public function index($id)
{
    $data = Produk::find($id);

    if (!$data) {
        return response()->json([
            'status' => false,
            'message' => 'Data not found',
        ], 404);
    }

    return response()->json([
        'status' => true,
        'message' => 'Data found',
        'data' => $data
    ], 200);
}

    public function store(Request $request)
    {
        // dd($request->all());
        //data validation
        $request->validate([
            "kode" => "required",
            "nama_produk" => "required",
            "harga" => "required",
            "stock" => "required",
            "gambar" => "required",
            "detail" => "required",
            "kategori_id" => "required",
            "cek" => ""
        ]);
        $cek = mt_rand(1, 999999);
        //data save
        Produk::create([
            "kode" => $request->kode,
            "nama_produk" => $request->nama_produk,
            "harga" => $request->harga,
            "stock" => $request->stock,
            "detail" => $request->detail,
            "gambar" => $request->gambar,
            "kategori_id" => $request->kategori_id,
            "cek" =>$cek

        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "Produk berhasil dibuat"
        ]);


    }
    public function show($id)
    {
        $product = Produk::find($id);

        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ControllersProdukController($product), 'Product retrieved successfully.');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (empty($produk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],);

        }
       
        $rules = [
            "kode" => "required",
            "nama_produk" => "required",
            "harga" => "required",
            "stock" => "required",
            "gambar" => "required",
            "detail" => "required",
            "kategori_id" => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message'=> 'gagal',
                'data' => $validator->errors()
            ]);
        }

        $produk->kode = $request->kode;


        // $post = $produk->save();


        return response()->json([
            'status'=> true,
            'message'=> 'sukses',

        ]);



    }

}
