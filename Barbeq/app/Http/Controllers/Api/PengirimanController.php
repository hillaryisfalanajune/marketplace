<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expedisi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

    class PengirimanController extends Controller
    {
        
       public function index()
{
    try {
        // Retrieve all records from the Pengiriman model
        $pengiriman = Expedisi::all();

        // Return a simpler response for debugging
        return response()->json([
            'status' => true,
            'message' => 'Data retrieved successfully',
            'data' => $pengiriman->toArray()
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}

    }
