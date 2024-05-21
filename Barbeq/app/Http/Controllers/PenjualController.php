<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PenjualController extends Controller
{
    public function index()
    {
        $users = User::where('isadmin', false)
                     ->where('issuperadmin', false)
                     ->get();

        return view('penjual.index', ['title' => 'Data Penjual', 'users' => $users]);
    }

    function store(Request $request)
    {//dd($request->all());

        $param = $request->except('_token', 'gambar');
        $validator = Validator::make($param, [
            'name' => 'required|max:100|min:5',
            'alamat' => 'required|max:200|min:5',
            'no_tlp' => 'required',
            'gambar' => 'image|file|max:1024',
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
            $file->move(public_path('produk-images'), $filename);
            $param['gambar'] = url('produk-images') . '/' . $filename;
        }

        $param['user_id'] = auth()->user()->id;
        $create = User::create($param);

        if ($create) {
            return redirect('User')->with('success', 'User Created');
        }
        return back()->with('error', 'Oops, something went wrong!');
    }


    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('user')->with('success', 'Produk Berhasil dihapus');
    }




    public function fnGetData(Request $request)
    {
        // set page parameter for pagination
        $data = User::where('isadmin', false)
                    ->where('issuperadmin', false)
                    ->where('id', '!=', 1);

        if ($request->input('search')['value'] != null && $request->input('search')['value'] != '') {
            $data = $data->where('id', 'LIKE', '%' . $request->keyword . '%')->orWhere('name', 'LIKE', '%' . $request->keyword . '%')
                ->whereHas('role', function ($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->keyword . '%');
                });
        }

        //Setting Limit
        $limit = 10;
        if (!empty($request->input('length'))) {
            $limit = $request->input('length');
        }

        $data = $data->orderBy($request->columns[$request->order[0]['column']]['name'], $request->order[0]['dir'])->paginate($limit);


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


}
