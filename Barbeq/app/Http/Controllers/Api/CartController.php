<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Pembeli;

class CartController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Extract the token from the request headers
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

            // Query cart items for the user
            $cart = Cart::with(['produk', 'pembeli'])->where('user_id', $userId)->get();

            // Check if cart is empty
            if ($cart->isEmpty()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Cart is empty for this user'
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Cart items retrieved successfully',
                    'data' => $cart
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is invalid'
            ], 401);
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
            "produk_id" => "required"
        ]);

        try {
            // Extract the token from the request headers
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

            // Create cart item
            Cart::create([
                "user_id" => $user->id,
                "produk_id" => $request->produk_id
            ]);

            // Return success response
            return response()->json([
                "status" => true,
                "message" => "Produk berhasil ditambah"
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Token is invalid'
            ], 401);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                "status" => false,
                "message" => "Error: " . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $cart = Cart::find($id);

            if (empty($cart)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }

            $cart->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
