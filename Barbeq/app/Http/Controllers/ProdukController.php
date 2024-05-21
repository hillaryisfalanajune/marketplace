<?php

namespace App\Http\Controllers;


use \Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\Kategori;
// use App\Models\Produk;

use App\Models\Produk;
use App\Services\Gateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{

    public function index()
    {

        if (auth()->user()->isadmin) {
            $produks = Produk::all();
        }

        else {
            $produks = Produk::where('user_id', auth()->id())->get();
        }

        return view('produk.index', ['title' => 'Produk', 'produks' => $produks]);
    }



    public function create()
    {
        return view('produk.create', ['title' => 'Tambah Produk', 'produks' => produk::all(), 'kategoris' => Kategori::all()]);

    }

    function store(Request $request)
    {//dd($request->all());

        $param = $request->except('_token', 'gambar');
        $validator = Validator::make($param, [
            'kode' => 'required|max:100|min:5',
            'nama_produk' => 'required|max:200|min:5',
            'harga' => 'required',
            'stock' => 'required',
            'gambar' => 'image|file|max:2048',
            'detail' => 'required',
            'kategori_id' => 'required',
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
            $file->move(public_path('../../public_html/produk-images'), $filename);

            $param['gambar'] = url('produk-images') . '/' . $filename;
        }

        $param['user_id'] = auth()->user()->id;
        $create = Produk::create($param);

        if ($create) {
            return redirect('produk')->with('success', 'Produk Created');
        }
        return back()->with('error', 'Oops, something went wrong!');
    }


    // Di dalam method edit() di ProdukController.php
    public function edit($id)
    {
        $produk = Produk::where('kode', $id)->first();
        $kategori = Kategori::all(); // Ambil semua data kategori
        return view('produk.update',['title'=>'Edit Produk '.$produk->nama_produk, 'produk' => $produk, 'kategori' => $kategori]);
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $param = $request->except('_method', '_token', 'gambar', 'oldImage', 'gambar');
        $validator = Validator::make($param, [
            'nama_produk' => 'max:200|min:5',
            'harga' => '',
            'stock' => '',
            'gambar' => 'image|file|max:1024',
            'detail' => '',
            'kategori_id' => '',

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
            $file->move(public_path('produk-images'), $filename);
            $param['gambar'] = url('produk-images') . '/' . $filename;
        }

        // if ($request->has('password')) {
        //     $param['password'] = Hash::make($request->input('password'));
        // }

        $update = Produk::where('kode', $id)->update($param);

        if ($update) {
            return redirect('produk')->with('success', 'User Updated');
        }
        return back()->with('error', 'User not Updated');
    }

    public function destroy($id)
    {
        Produk::where('kode', $id)->delete();
        return redirect('produk')->with('success', 'Produk Berhasil dihapus');
    }




    public function fnGetData(Request $request)
    {
        // set page parameter for pagination
        $page = ($request->start / $request->length) + 1;
        $request->merge(['page' => $page]);

        $data  = new Produk();
        $data = $data->where('id', '!=', 1)->with('id');

        if ($request->input('search')['value'] != null && $request->input('search')['value'] != '') {
            $data = $data->where('kode', 'LIKE', '%' . $request->keyword . '%')->orWhere('nama_produk', 'LIKE', '%' . $request->keyword . '%')
                ->whereHas('role', function ($query) use ($request) {
                    $query->where('nama_produk', 'LIKE', '%' . $request->keyword . '%');
                });
        }

        //Setting Limit
        $limit = 10;
        if (!empty($request->input('length'))) {
            $limit = $request->input('length');
        }

        $data = $data->orderBy($request->columns[$request->order[0]['column']]['nama_produk'], $request->order[0]['dir'])->paginate($limit);


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
                $btn = '<a class="btn btn-default" href="admin/' . $data->produk_id . '">Edit</a>';
                $btn .= ' <button class="btn btn-danger btn-xs btnDelete" style="padding: 5px 6px;" onclick="fnDelete(this,' . $data->user_id . ')">Delete</button>';
                return $btn;
            })
            ->rawColumns(['gambar', 'action'])
            ->make(true);
    }
    
     public function getByCategory(Request $request)
    {
        $categoryId = $request->query('kategori_id');

        try {
            $products = Product::where('kategori_id', $categoryId)->get();

            return response()->json([
                'status' => true,
                'message' => 'Products fetched successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
