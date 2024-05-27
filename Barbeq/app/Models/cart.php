<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "carts";
    protected $fillable = [

        'nama_produk',
        'harga',
        'gambar',
        'user_id',
        'penjual_id',
        'produk_id',

    ];
    public function pembeli()
    {
        return $this->belongsTo(User::class,'penjual_id');
    }
 

}
