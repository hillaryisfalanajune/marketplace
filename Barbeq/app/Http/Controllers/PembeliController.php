<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use \Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use  Illuminate\Support\Facades\Validator;

class PembeliController extends Controller
{
    public function index(Request $request)
    {
        $pembelis = Pembeli::all();
        return view('pembeli.index', ['title' => 'Pembeli', 'pembelis' => $pembelis]);
    }


    function store(Request $request)
    {//dd($request->all());

        $param = $request->except('_token', 'gambar');
        $validator = Validator::make($param, [
            // 'kode' => 'required|max:100|min:4',
            'nama_pembeli' => 'required|min:2|max:100',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:200',
            'no_tlp' => 'required|min:6|max:15',
            'alamat_pmbeli' => 'required|min:6|max:500',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:1024',


        ]);
        if ($validator->fails()) {

            $errors = $validator->errors()->messages();
            $messages = [];
            foreach ($errors as $key => $value) {
                $messages = $value[0];
            }
            return back()->with('error', $messages);
        }
        // dd($param);
        $param['gambar'] = '';
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $request->gambar->extension();
            $file->move(public_path('pembeli-images'), $filename);
            $param['gambar'] = url('pembeli-images') . '/' . $filename;
        }

        $param['user_id'] = auth()->user()->id;
        $create = Pembeli::create($param);

        if ($create) {
            return redirect('pembeli')->with('success', 'Pembeli Created');
        }
        return back()->with('error', 'Oops, something went wrong!');
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $param = $request->except('_method', '_token', 'gambar', 'oldImage', 'gambar');
        $validator = Validator::make($param, [
            // 'kode' => 'required|max:100|min:4',
            'nama_pembeli' => 'required|min:2|max:100',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:6|max:200',
            'no_tlp' => 'required|min:6|max:15',
            'alamat_pmbeli' => 'required|min:6|max:500',
            'gambar' => 'image|mimes:jpg,jpeg,png|max:1024',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->messages();
            $messages = [];
            foreach ($errors as $key => $value) {
                $messages = $value[0];
            }
            return back()->with('error', $messages);
        }

        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $request->gambar->extension();
            $file->move(public_path('pembeli-images'), $filename);
            $param['gambar'] = url('pembeli-images') . '/' . $filename;
        }

        // if ($request->has('password')) {
        //     $param['password'] = Hash::make($request->input('password'));
        // }

        $update = Pembeli::where('id', $id)->update($param);

        if ($update) {
            return redirect('pembeli')->with('success', 'User Updated');
        }
        return back()->with('error', 'User not Updated');
    }

    public function destroy($id)
    {
        Pembeli::where('id', $id)->delete();
        return redirect('pembeli')->with('success', 'Pembeli Berhasil dihapus');
    }




    public function fnGetData(Request $request)
    {
        // set page parameter for pagination
        $page = ($request->start / $request->length) + 1;
        $request->merge(['page' => $page]);

        $data  = new Pembeli();
        $data = $data->where('id', '!=', 1)->with('id');

        if ($request->input('search')['value'] != null && $request->input('search')['value'] != '') {
            $data = $data->where('id', 'LIKE', '%' . $request->keyword . '%')->orWhere('nama_pembeli', 'LIKE', '%' . $request->keyword . '%')
                ->whereHas('role', function ($query) use ($request) {
                    $query->where('nama_pembeli', 'LIKE', '%' . $request->keyword . '%');
                });
        }

        //Setting Limit
        $limit = 10;
        if (!empty($request->input('length'))) {
            $limit = $request->input('length');
        }

        $data = $data->orderBy($request->columns[$request->order[0]['column']]['nama_pembeli'], $request->order[0]['dir'])->paginate($limit);


        $data = json_encode($data);
        $data = json_Decode($data);

        return DataTables::of($data->data)
            ->skipPaging()
            ->setTotalRecords($data->total)
            ->setFilteredRecords($data->total)
            ->addColumn('gambar', function ($data) {
                return '<img src="' . $data->gambar . '" class="img-circle" style="width:50px">';
            })
            ->addColumn('action', function ($data) {
                $btn = '<a class="btn btn-default" href="admin/' . $data->user_id . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->user_id . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambar', 'action'])
            ->make(true);
    }
}
