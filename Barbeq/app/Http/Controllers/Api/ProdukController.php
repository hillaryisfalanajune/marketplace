<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProdukController as ControllersProdukController;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
   public function index()
{
    $data = Produk::select('produks.*', 'kategoris.kategori')
                    ->join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
                    ->get();

    return response()->json([
        'status' => true,
        'message' => 'Data diterima',
        'data' => $data
    ], 200);
}

    public function kategori()
    {
        $data = Kategori::get()->all();
        return response()->json([
            'status'=>true,
            'message'=>'Data diterima',
            'data'=>$data

        ],200
        );
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        //data validation
        $request->validate([
            "kode" => "required",
            "nama_produk" => "required",
            "harga" => "required",
            "stock" => "required",
            "gambar" => "required",
            "detail" => "required",
            "kategori_id" => "required",
            "cek" => ""
        ]);
        $cek = mt_rand(1, 999999);
        //data save
        Produk::create([
            "kode" => $request->kode,
            "nama_produk" => $request->nama_produk,
            "harga" => $request->harga,
            "stock" => $request->stock,
            "detail" => $request->detail,
            "gambar" => $request->gambar,
            "kategori_id" => $request->kategori_id,
            "cek" =>$cek

        ]);

        //response
        return response()->json([
            "status" => true,
            "message" => "Produk berhasil dibuat"
        ]);


    }
    public function show($id)
    {
       $data = Produk::find($id);

    if (!$data) {
        return response()->json([
            'status' => false,
            'message' => 'Data not found',
        ], 404);
    }

    return response()->json([
        'status' => true,
        'message' => 'Data found',
        'data' => $data
    ], 200);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        if (empty($produk)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);

        }
       
        $rules = [
            "kode" => "required",
            "nama_produk" => "required",
            "harga" => "required",
            "stock" => "required",
            "gambar" => "required",
            "detail" => "required",
            "kategori_id" => "required",
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message'=> 'gagal',
                'data' => $validator->errors()
            ]);
        }

        $produk->kode = $request->kode;


        // $post = $produk->save();


        return response()->json([
            'status'=> true,
            'message'=> 'sukses',

        ]);



    }
    
    public function search(Request $request)
{
    $query = $request->input('query');

    // Check if the query is empty
    if (empty($query)) {
        return response()->json([
            'status' => false,
            'message' => 'Empty search query',
            'data' => [],
        ], 400);
    }

    // Perform search query
    $results = Produk::where('nama_produk', 'like', "%$query%")->get();

    return response()->json([
        'status' => true,
        'message' => 'Search results',
        'data' => $results,
    ], 200);
}
public function getByCategory(Request $request)
    {
        // Get the category ID from the request query parameters
        $categoryId = $request->query('kategori_id');

        try {
            // Find the category in the kategoris table
            $category = Kategori::find($categoryId);

            // Check if the category exists
            if (!$category) {
                return response()->json([
                    'status' => false,
                    'message' => 'Category not found'
                ], 404);
            }

            // Fetch products that match the kategori_id
            $products = Produk::where('kategori_id', $category->id)->get();

            // Return the products
            return response()->json([
                'status' => true,
                'message' => 'Products fetched successfully',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            // Handle any exceptions
            return response()->json([
                'status' => false,
                'message' => 'Failed to fetch products',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
