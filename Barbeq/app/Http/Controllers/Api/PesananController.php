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
            // Check if the token is present
            if (!$request->header('Authorization')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token is absent'
                ], 401);
            }

            // Extract the token from the request headers
            $token = $request->header('Authorization');
            
            // Decode the token to extract user information
            $decodedToken = JWTAuth::decode(JWTAuth::getToken());
            
            // Extract user ID from decoded token payload
            $userId = $decodedToken['sub'];
            
            // Find the user's orders by user ID, including related product and pembeli data
            $data = Pesanan::where('pembeli_id', $userId)->with(['produk', 'pembeli','expedisi'])->get();
            
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
            // Check if the token is present
            if (!$request->header('Authorization')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Token is absent'
                ], 401);
            }

            $token = $request->header('Authorization');
            $decodedToken = JWTAuth::decode(JWTAuth::getToken());
            $userId = $decodedToken['sub'];
            $user = Pembeli::find($userId);
            
            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found"
                ], 404);
            }

            $buktiTransferPath = null;

            if ($request->cara_bayar != '1' && $request->hasFile('gambar')) {
                $buktiTransferFile = $request->file('gambar');
                $buktiTransferFilename = pathinfo($buktiTransferFile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $buktiTransferFile->getClientOriginalExtension();
                $buktiTransferFilename = $buktiTransferFilename . '_' . time() . '.' . $extension;
                $buktiTransferFile->move(public_path('../../public_html/pesanan-images'), $buktiTransferFilename);
                $websiteUrl = url('/');
                $buktiTransferPath = $websiteUrl . '/pesanan-images/' . $buktiTransferFilename;
            }

            $pesanan = Pesanan::create([
                "produk_id" => $request->produk_id,
                "pembeli_id" => $userId,
                "alamat" => $request->alamat,
                "user_id" => $request->user_id,
                "gambar" => $buktiTransferPath, // Corrected duplication issue
                "bayar_id" => $request->bayar_id,
                "status_id" => $request->status_id,
                "expedisi_id" => $request->expedisi_id,
                "harga" => $request->harga
            ]);

            // Reduce stock of the product by 1
            $produk = Produk::find($request->produk_id);
            if ($produk && $produk->stock > 0) {
                $produk->stock -= 1;
                $produk->save();
            } else {
                // Rollback the order if product stock is insufficient
                $pesanan->delete();
                return response()->json([
                    "status" => false,
                    "message" => "Stock not sufficient"
                ], 400);
            }

            return response()->json([
                "status" => true,
                "message" => "Pesanan berhasil dibuat"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the order by ID
            $pesanan = Pesanan::find($id);
            if (empty($pesanan)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            // Validate the request data
            $rules = [
                "produk_id" => "",
                "alamat" => "",
                "user_id" => "",
                "bayar_id" => "",
                "status_id" => "",
                "expedisi_id" => "",
                "harga" => ""
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal validasi',
                    'data' => $validator->errors()
                ], 400);
            }

            // Handle the file upload if present
            $buktiTransferPath = $pesanan->gambar;
            if ($request->cara_bayar != '1' && $request->hasFile('gambar')) {
                $buktiTransferFile = $request->file('gambar');
                $buktiTransferFilename = pathinfo($buktiTransferFile->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $buktiTransferFile->getClientOriginalExtension();
                $buktiTransferFilename = $buktiTransferFilename . '_' . time() . '.' . $extension;
                $buktiTransferFile->move(public_path('../../public_html/pesanan-images'), $buktiTransferFilename);
                $websiteUrl = url('/');
                $buktiTransferPath = $websiteUrl . '/pesanan-images/' . $buktiTransferFilename;
            }

            // Update the order data
            $pesanan->update([
                "produk_id" => $request->produk_id,
                "alamat" => $request->alamat,
                "user_id" => $request->user_id,
                "gambar" => $buktiTransferPath,
                "bayar_id" => $request->bayar_id,
                "status_id" => $request->status_id,
                "expedisi_id" => $request->expedisi_id,
                "harga" => $request->harga
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Pesanan berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
