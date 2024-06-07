<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "wishlists";
    protected $fillable = [

        'id_wish',
        'user_id'



    ];
    public function kategori()
    {
        //Post ke Categories Relasi satu ke satu
        return $this->belongsTo(Kategori::class);

    }
    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_wish');
    }
    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class,'user_id');
    }
}
