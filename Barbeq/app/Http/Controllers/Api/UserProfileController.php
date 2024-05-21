<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use \Firebase\JWT\JWT;

class UserProfileController extends Controller
{
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

   public function update(Request $request)
{
    try {
        // Extract the token from the request headers
        $token = $request->header('Authorization');

        // Decode the token to extract user information
        $decodedToken = JWTAuth::parseToken()->getPayload();

        // Extract user ID from decoded token payload
        $userId = $decodedToken['sub'];

        // Find the user by ID
        $userProfile = Pembeli::find($userId);

        // Check if the user exists
        if (!$userProfile) {
            return response()->json([
                'status' => false,
                'message' => 'User not found'
            ], 404);
        }

        // Validate the request data including image
        $validator = Validator::make($request->all(), [
            "name" => "nullable|string|max:255",
            "no_tlp" => "nullable|string|max:20",
            "email" => "nullable|email|max:255",
            "gambar" => "nullable|image|mimes:jpeg,png,jpg,gif|max:10000",
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update user profile data
        if ($request->has('name')) {
            $userProfile->name = $request->name;
        }
        if ($request->has('no_tlp')) {
            $userProfile->no_tlp = $request->no_tlp;
        }
        if ($request->has('email')) {
            $userProfile->email = $request->email;
        }

        // Handle image upload if provided
        if ($request->hasFile('gambar')) {
            // Delete the old image if it exists
            if ($userProfile->gambar) {
                $oldImagePath = public_path('../../public_html/pembeli-images/' . $userProfile->gambar);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Store new image with the original file name
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('../../public_html/pembeli-images'), $imageName);
            $userProfile->gambar = url('pembeli-images/' . $imageName); // Store the full URL in the database
        }

        $userProfile->save();

        // Prepare the response data with full image URL
        $responseData = $userProfile->toArray();
        if ($userProfile->gambar) {
            // Append the default link to the image name
            $responseData['gambar'] = url('pembeli-images/' . $userProfile->gambar);
        }

        // Return success response
        return response()->json([
            'status' => true,
            'message' => 'User profile updated successfully',
            'data' => $responseData
        ], 200);

    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json([
            'status' => false,
            'message' => 'Failed to update user profile',
            'error' => $e->getMessage(),
        ], 500);
    }
}



}
