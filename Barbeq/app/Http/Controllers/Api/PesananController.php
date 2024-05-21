<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Firebase\JWT\JWT;
use App\Models\Pembeli;

class PesananController extends Controller
{
     public function index(Request $request)
{
    try {
        // Extract the token from the request headers
        $token = $request->header('Authorization');
        
        // Decode the token to extract user information
        $decodedToken = JWTAuth::decode(JWTAuth::getToken());
        
        // Extract user ID from decoded token payload
        $userId = $decodedToken['sub'];
        
        // Find the user's orders by user ID, including related product and pembeli data
        $data = Pesanan::where('pembeli_id', $userId)->with(['produk', 'pembeli'])->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Data diterima',
            'data' => $data
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}


    
public function store(Request $request)
{
    try {
        // Extract the token from the request headers
        $token = $request->header('Authorization');
        
        // Decode the token to extract user information
        $decodedToken = JWTAuth::decode(JWTAuth::getToken());
        
        // Extract user ID from decoded token payload
        $userId = $decodedToken['sub'];
        
        // Find the user by ID
        $user = Pembeli::find($userId);
        
        // Check if the user exists
        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ], 404);
        }

        // Extract user ID
        $userId = $user->id;

        $buktiTransferPath = null; // Default value for bukti_transfer

        // Handle file upload for 'bukti_transfer' only if cara_bayar is not 1
        if ($request->cara_bayar != '1' && $request->hasFile('bukti_transfer')) {
            // Get the file from the request
            $buktiTransferFile = $request->file('bukti_transfer');
            
            // Extract filename from the uploaded file's path
            $buktiTransferFilename = pathinfo($buktiTransferFile->getClientOriginalName(), PATHINFO_FILENAME);
            
            // Get the extension of the uploaded file
            $extension = $buktiTransferFile->getClientOriginalExtension();
            
            // Generate a unique filename based on the original filename and extension
            $buktiTransferFilename = $buktiTransferFilename . '_' . time() . '.' . $extension;
            
            // Move the file to the storage directory
            $buktiTransferFile->move(public_path('../../public_html/pesanan-images'), $buktiTransferFilename);
            
            // Get the URL of the website
            $websiteUrl = url('/');
            
            // Set the image path for bukti_transfer using the website URL
            $buktiTransferPath = $websiteUrl . '/pesanan-images/' . $buktiTransferFilename;
        }

        // If user ID extraction is successful, create the Pesanan
        Pesanan::create([
            "produk_id" => $request->produk_id,
            "pembeli_id" => $userId, // Assign the user ID from the token to pembeli_id
            "alamat" => $request->alamat,
            "user_id" => $request->user_id,
            "gambar" => $buktiTransferPath ? $buktiTransferFile : null, // Store the image path in the database for 'gambar'
            "bukti_transfer" => $buktiTransferPath, // Store the image path in the database for 'bukti_transfer'
            "cara_bayar" => $request->cara_bayar,
            "status_id"=> $request -> status_id
        ]);

        // Return success response
        return response()->json([
            "status" => true,
            "message" => "Pesanan berhasil dibuat"
        ], 200);
    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json([
            "status" => false,
            "message" => "Error: " . $e->getMessage()
        ], 500);
    }
}





    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::find($id);
        if (empty($pesanan)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);

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
