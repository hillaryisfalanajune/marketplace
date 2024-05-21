<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Keuangan;
use Illuminate\Http\Request;

class KeuanganController extends Controller
{

    public function index()
    {
        $keuangans = Keuangan::latest()->filter(request(['search']))->paginate(3);
        return view('keuangan.index', ['title' => 'Keuangan', 'keuangans' => $keuangans]);
    }

    function store(Request $request)
    {
        $param = $request->except('_token', 'gambar');
        $validator = Validator::make($param, [
            'id' => 'required',



        ]);
        if ($validator->fails()) {

            $errors = $validator->errors()->messages();
            $messages = [];
            foreach ($errors as $key => $value) {
                $messages = $value[0];
            }
            return back()->with('error', $messages);
        }

    }
}
