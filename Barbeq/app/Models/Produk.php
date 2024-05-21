<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['author','kategori'];
    protected $table = "produks";
    protected $fillable = [
        'kode',
        'nama_produk',
        'harga',
        'gambar',
        'detail',
        'stock',
        'kategori_id',
        'user_id'

    ];


    // public function scopeFilter($query, array $filters){

    //     $query->when($filters['search'] ?? false,function($query,$search){
    //         return
    //         $query->where('id','like','%'. $search.'%')
    //         ->orWhere('nama_produk','like','%'. $search.'%');
    //     });


    //     $query->when(
    //         //author berasal dari url yang di kirim
    //         $filters['author'] ?? false,
    //         fn ($query,$author) =>
    //         //author berasal dari relasi method public function author()
    //         $query->whereHas('author',
    //             fn($query) =>
    //             $query->where('username', $author)
    //         )

    //     );

    // }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        //Post ke Categories Relasi satu ke satu
        return $this->belongsTo(User::class,'user_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    
    public function getRouteKeyName()
    {
        return 'kode';
    }
}
