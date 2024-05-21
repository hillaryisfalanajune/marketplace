<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {

        $kategori = Kategori::get()->all();
        // dd($request->all());
        if (empty($kategori)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' =>$kategori
            ],);
        }

    }
}
