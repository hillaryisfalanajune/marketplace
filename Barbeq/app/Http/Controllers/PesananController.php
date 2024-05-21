<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Statusverifikasi;
use App\Models\Rekening;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->isadmin) {
            // Jika user adalah admin, tampilkan semua pesanan
            $pesanans = Pesanan::with(['produk', 'pembeli', 'statusverifikasi', 'rekening'])
                ->get();
        } else {
            // Jika user adalah penjual biasa, tampilkan pesanan miliknya sendiri
            $pesanans = Pesanan::where('user_id', $user->id)
                ->with(['produk', 'pembeli', 'statusverifikasi', 'rekening'])
                ->get();
        }

        return view('pesanan.index', [
            'title' => 'Pesanan',
            'pesanans' => $pesanans,
            'pembelis' => Pembeli::all(),
            'statusverifikasis' => Statusverifikasi::all(),
            'users' => User::all(),
            'produks' => Produk::all(),
            'rekenings' => Rekening::all()
        ]);
    }
    public function store(Request $request)
    {
        $param = $request->except('_token', 'gambar');

        // Validasi
        $validator = Validator::make($param, [
            'produk_id' => 'required',
            'pembeli_id' => 'required',
            'user_id' => 'required',
            'status_id' => '',
            'cara_bayar' => '',
            'bukti_transfer' => '',
            'statusverifikasi_id' => '',
            'rekening_id' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pesanans = Pesanan::create($param);

        if ($pesanans) {
            return redirect('pesanan')->with('success', 'Pesanan Created');
        }

        return back()->with('error', 'Oops, something went wrong!');
    }

    public function update(Request $request, $id)
    {
        $param = $request->except('_method', '_token', 'gambar', 'oldImage');

        // Validasi
        $validator = Validator::make($param, [
            'produk_id' => 'required',
            'pembeli_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $update = Pesanan::where('id', $id)->update($param);

        if ($update) {
            return redirect('pesanan')->with('success', 'Pesanan Updated');
        }

        return back()->with('error', 'Pesanan not Updated');
    }


    public function updateStatusverifikasi(Request $request, $id)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'statusverifikasi_id' => 'required|exists:statusverifikasis,id'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->statusverifikasi_id = $request->statusverifikasi_id;

        if ($pesanan->save()) {
            return redirect('pesanan')->with('success', 'Status verifikasi berhasil diperbarui');
        }

        return back()->with('error', 'Gagal memperbarui status verifikasi');
    }


    public function destroy($id)
    {
        Pesanan::where('id', $id)->delete();
        return redirect('pesanan')->with('success', 'Pesanan Berhasil dibatalkan');
    }

    public function fnGetData(Request $request)
    {
        // set page parameter for pagination
        $page = ($request->start / $request->length) + 1;
        $request->merge(['page' => $page]);

        $data = Pesanan::query();

        if ($request->input('search')['value'] != null && $request->input('search')['value'] != '') {
            $data = $data->where('id', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('produk_id', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('pembeli_id', 'LIKE', '%' . $request->keyword . '%')
                ->orWhere('user_id', 'LIKE', '%' . $request->keyword . '%');
        }

        //Setting Limit
        $limit = 10;
        if (!empty($request->input('length'))) {
            $limit = $request->input('length');
        }

        $data = $data->orderBy($request->columns[$request->order[0]['column']]['name'], $request->order[0]['dir'])
            ->paginate($limit);

        return DataTables::of($data)
            ->skipPaging()
            ->make(true);
    }
}
