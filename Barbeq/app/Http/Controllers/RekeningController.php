<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rekening;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::where('user_id', auth()->id())->get();
        return view('rekening.index', ['title' => 'Daftar Rekening Anda', 'rekenings' => $rekenings]);
    }

    public function create()
    {
        return view('rekening.create', ['title' => 'Tambah Rekening']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'nama_pemilik' => 'required',
        ]);

        $request->merge(['user_id' => auth()->id()]); // tambahkan user_id sebelum menyimpan

        Rekening::create($request->all());

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil ditambahkan.');
    }

    public function edit($id)
{
    $rekening = Rekening::findOrFail($id);
    return view('rekening.update', ['title' => 'Edit Rekening', 'rekening' => $rekening]);
}

    public function update(Request $request, Rekening $rekening)
    {
        $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'nama_pemilik' => 'required',
        ]);

        $rekening->update($request->all());

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil diperbarui.');
    }

    public function destroy(Rekening $rekening)
    {
        $rekening->delete();

        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dihapus.');
    }
}
