<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Rekening;

class RekeningController extends Controller
{
    public function index()
    {
        $rekenings = Rekening::where('user_id', auth()->id())->get();
        return view('rekening.index', [
            'title' => 'Daftar Rekening ',
            'rekenings' => $rekenings,
            'users' => User::all(),
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        // Cek apakah pengguna adalah admin atau sudah memiliki rekening
        if (!$user->isadmin && Rekening::where('user_id', $user->id)->exists()) {
            return redirect()->route('rekening.index')->with('error', 'Anda hanya boleh memiliki satu rekening.');
        }

        return view('rekening.create', ['title' => 'Tambah Rekening']);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Cek apakah pengguna adalah admin atau sudah memiliki rekening
        if (!$user->isadmin && Rekening::where('user_id', $user->id)->exists()) {
            return redirect()->route('rekening.index')->with('error', 'Anda hanya boleh memiliki satu rekening.');
        }

        $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'nama_pemilik' => 'required',
        ]);

        $request->merge(['user_id' => $user->id]); // tambahkan user_id sebelum menyimpan

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
