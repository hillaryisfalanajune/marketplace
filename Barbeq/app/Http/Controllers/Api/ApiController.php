<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembeli;
use Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Firebase\JWT\JWT;

class ApiController extends Controller
{
    //Register API(POST,form data)
    public function register(Request $request){

        //data validation
        $request->validate([
            "name" => "required",
            "no_tlp" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|"
        ]);
        //data save
        Pembeli::create([
            "name" => $request->name,
            "no_tlp" => $request->no_tlp,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "User created successfully"
        ]);

    }
    //Login API(POST,form data)

        public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email'  =>  'required',
                'password' => 'required'
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Failed',
                    'data' => $validator->errors(),
                ], 400);
            }
        
            $user = Pembeli::where('email', $request->email)->first(); // Fetch user from the database
            
            if (!$user || !Hash::check($request->password, $user->password)) { // Check if user exists and password is correct
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Email/Username or Password',
                ], 404);
            }
            
            $token = JWTAuth::fromUser($user);
        
            return response()->json([
                'success' => true,
                'message' => 'Login Success',
                'data' => ['token' => $token, 'user' => $user],
            ], 200);
        }


    //Profile API(GET)
    public function profile(Request $request)
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
                "success" => false,
                "message" => "User not found"
            ], 404);
        }

        // Return the user data
        return response()->json([
            "success" => true,
            "message" => "Profile data",
            "data" => [
                "user" => $user,
            ],
        ], 200);
    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json([
            "success" => false,
            "message" => "Failed to fetch profile data",
            "error" => $e->getMessage(),
        ], 500);
    }
}
    //Refresh Token API(GET)
    public function refreshToken(){

        $newToken = auth()->refresh();

        return response()->json([
            "status" => true,
            "message" => "New Accces token generated",
            "token" => $newToken
        ]);
    }
    //Logout API(GET)
   public function logout(){
    auth()->logout();

    return response()->json([
        "status" => true,
        "message" => "User logged out successfully"
    ])->cookie(Cookie::forget('token')); // This line deletes the token cookie
}

}
