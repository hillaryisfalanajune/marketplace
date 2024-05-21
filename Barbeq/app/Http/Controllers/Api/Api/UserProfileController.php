<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function index()
    {

        $userprofile = User::get()->all();
        // dd($request->all());
        if (empty($userprofile)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],);
        }else{
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' =>$userprofile
            ],);
        }
    }

    public function update(Request $request, $id)
    {
        $userprofile = User::find($id);
        // dd($request->all());
        if (empty($userprofile)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
        $rules = [
            "name" => "required",
            "username" => "required",
            "email" => "required",


        ];

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> true,
                'message'=> 'gagal',
                'data' => $validator->errors()
            ]);
        }

        $userprofile->name = $request->name;
        $userprofile->username = $request->username;
        $userprofile->email = $request->email;


        return response()->json([
            'status'=> true,
            'message'=> 'sukses',
            'data ' => $userprofile

        ]);

    }

}
