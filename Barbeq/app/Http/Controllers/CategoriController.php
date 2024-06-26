<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->isadmin) {
            $kategoris = Kategori::all();
        } else {
            $kategoris = Kategori::where('user_id', auth()->id())->get();
        }

        return view('categori.index', ['title' => 'Kategori produk', 'kategoris' => $kategoris]);
    }

    public function create()
    {
        return view('categori.create', [
            'title' => 'Tambah Kategori produk',
            'kategoris' => Kategori::all(),
            'produks' => Produk::all()
        ]);
    }

    public function store(Request $request)
    {
        $param = $request->except('_token', 'gambar');
        $param['user_id'] = auth()->id(); // Menyimpan ID pengguna yang saat ini masuk

        $validator = Validator::make($param, [
            'kode' => 'required',
            'kategori' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return back()->with('error', implode(', ', $errors));
        }

        $create = Kategori::create($param);

        if ($create) {
            return redirect('categori')->with('success', 'Kategori Created');
        }

        return back()->with('error', 'Oops, something went wrong!');
    }

  public function destroy($id)
{
    Produk::where('id', $id)->delete();
    return redirect('categori')->with('success', 'Kategori Berhasil dihapus');
}

    public function fnGetData(Request $request)
    {
        $page = ($request->start / $request->length) + 1;
        $request->merge(['page' => $page]);

        $data = Kategori::where('id', '!=', 1);

        if ($request->input('search')['value']) {
            $keyword = $request->input('search')['value'];
            $data = $data->where(function($query) use ($keyword) {
                $query->where('kode', 'LIKE', '%' . $keyword . '%')
                      ->orWhere('kategori', 'LIKE', '%' . $keyword . '%');
            });
        }

        $limit = $request->input('length') ?? 10;
        $data = $data->orderBy($request->columns[$request->order[0]['column']]['kategori'], $request->order[0]['dir'])->paginate($limit);

        return DataTables::of($data)
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
