<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CartController as ControllersCartController;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Firebase\JWT\JWT;
use App\Models\Pembeli;

class CartController extends Controller
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
        
        // Find the user by ID
        $user = Pembeli::find($userId);
        
        // Check if the user exists
        if (!$user) {
            return response()->json([
                "status" => false,
                "message" => "User not found"
            ], 404);
        }


        // Query wishlist items for the user
        $query = Cart::where('user_id', $userId);


        // Get wishlist items based on the query
        $cart = $query->get();

        // Check if wishlist is empty
        if ($cart->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'cart is empty for this user'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'cart items retrieved successfully',
                'data' => $cart
            ]);
        }
    } catch (Exception $e) {
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
        "nama_produk" => "required",
        "harga" => "required",
        "gambar" => "required",

    ]);

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


        // Create wishlist item
        Cart::create([
            "nama_produk" => $request->nama_produk,
            "harga" => $request->harga,
            "gambar" => $request->gambar,
            "user_id" => $user->id
        ]);

        // Return success response
        return response()->json([
            "status" => true,
            "message" => "Produk berhasil ditambah"
        ]);
            } catch (Exception $e) {
        // Handle any exceptions
        return response()->json([
            "status" => false,
            "message" => "Error: " . $e->getMessage()
        ], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $cart = cart::find($id);
    //     if (empty($cart)) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Data tidak ditemukan'
    //         ]);

    //     }
    //     // $produk::update([
    //     //     "kode" => $request->kode,
    //     //     "nama_produk" => $request->nama_produk,
    //     //     "harga" => $request->harga,
    //     //     "stock" => $request->stock,
    //     //     "detail" => $request->detail,
    //     //     "gambar" => $request->gambar,
    //     //     "kategori_id" => $request->kategori_id,
    //     // ]);
    //     $rules = [
    //         "nama_produk" => "required",
    //         "harga" => "required",
    //         "gambar" => "required",
    //     ];
    //     $validator = Validator::make($request->all(),$rules);
    //     if ($validator->fails()){
    //         return response()->json([
    //             'status'=> false,
    //             'message'=> 'gagal',
    //             'data' => $validator->errors()
    //         ]);
    //     }

    //     $cart->kode = $request->kode;


    //     // $post = $produk->save();


    //     return response()->json([
    //         'status'=> true,
    //         'message'=> 'sukses',

    //     ]);

    // }
     public function destroy($id)
{
    $cart = cart::find($id);

    if (empty($cart)) {
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    $cart->delete();

    return response()->json([
        'status' => true,
        'message' => 'Data berhasil dihapus'
    ]);
}

}
