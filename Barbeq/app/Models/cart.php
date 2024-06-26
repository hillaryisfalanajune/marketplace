<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "carts";
    protected $fillable = [

        'user_id',
        'produk_id',

    ];
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class,'user_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class,'produk_id');
    }
 

}
