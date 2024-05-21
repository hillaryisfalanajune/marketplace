<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PromoController as ControllersPromoController;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PromoController extends Controller
{
    public function index()
    {
        $data = Promo::get()->all();
        return response()->json([
            'status'=>true,
            'message'=>'Data diterima',
            'data'=>$data

        ],200
        );
    }


}
