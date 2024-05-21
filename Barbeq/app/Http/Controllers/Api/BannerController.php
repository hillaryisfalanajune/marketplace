<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        
        return response()->json([
            'status' => true,
            'message' => 'Data diterima',
            'data' => $banner
        ], 200);
    }
}
