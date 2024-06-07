<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Pembeli;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Firebase\JWT\JWT;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Check if the token is present
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Authorization token not provided'
                ], 401);
            }

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

            // Get the product ID from the request parameters, if provided
            $productId = $request->input('product_id');

            // Query wishlist items for the user
            $query = Wishlist::with(['produk', 'pembeli'])->where('user_id', $userId);

            // If a product ID is provided, filter by that ID
            if ($productId) {
                $query->where('id_wish', $productId);
            }

            // Get wishlist items based on the query
            $wishlist = $query->get();

            // Check if wishlist is empty
            if ($wishlist->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wishlist is empty for this user'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Wishlist items retrieved successfully',
                    'data' => $wishlist
                ]);
            }
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            "id_wish" => "",
            "user_id" => ""
        ]);

        try {
            // Check if the token is present
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Authorization token not provided'
                ], 401);
            }

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

            // Check if the wishlist item already exists for the user
            $existingWishlistItem = Wishlist::where('id_wish', $request->id_wish)
                                          ->where('user_id', $user->id)
                                          ->first();

            // If the wishlist item already exists for the user, return an error response
            if ($existingWishlistItem) {
                return response()->json([
                    "status" => false,
                    "message" => "Item already exists in the wishlist for this user"
                ], 409);
            }

            // Create wishlist item
            Wishlist::create([
                "id_wish" => $request->id_wish,
                "user_id" => $user->id,
            ]);

            // Return success response
            return response()->json([
                "status" => true,
                "message" => "Produk berhasil ditambah"
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function show(Request $request, $productId)
    {
        try {
            // Check if the token is present
            $token = $request->header('Authorization');

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Authorization token not provided'
                ], 401);
            }

            // Decode the token to extract user information
            $decodedToken = JWTAuth::decode(JWTAuth::getToken());

            // Extract user ID from decoded token payload
            $userId = $decodedToken['sub'];

            // Find the wishlist item for the user and product ID
            $wishlistItem = Wishlist::where('user_id', $userId)
                                ->where('id', $productId)
                                ->first();

            // Check if wishlist item exists
            if ($wishlistItem) {
                return response()->json([
                    'status' => true,
                    'message' => 'Product found in wishlist',
                    'data' => $wishlistItem
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Product not found in wishlist'
                ], 404);
            }
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
        $wishlist = Wishlist::find($id);
        
        if (empty($wishlist)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $rules = [
            "nama_product" => "required",
            "harga" => "required",
            "gambar" => "required",
            "detail" => "required",
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'gagal',
                'data' => $validator->errors()
            ]);
        }

        $wishlist->nama_product = $request->nama_product;
        $wishlist->harga = $request->harga;
        $wishlist->gambar = $request->gambar;
        $wishlist->detail = $request->detail;

        return response()->json([
            'status' => true,
            'message' => 'sukses',
        ]);
    }

    public function destroy($id)
    {
        $wishlistItem = Wishlist::find($id);

        if (empty($wishlistItem)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        $wishlistItem->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
