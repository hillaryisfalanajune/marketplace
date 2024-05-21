<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\anggota;
use Illuminate\Support\Facades\Validator;


class AnggotaController extends Controller
{
     public function index()
    {
        $data = anggota::get()->all();
        return response()->json([
            'status'=>true,
            'message'=>'Data diterima',
            'data'=>$data

        ],200
        );
    }
}