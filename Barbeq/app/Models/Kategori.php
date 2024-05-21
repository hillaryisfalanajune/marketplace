<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = ['id'];//tidak boleh manual diisi


    // public function scopeFilter($query, array $filters){

    //     $query->when($filters['search'] ?? false,function($query,$search){
    //         return
    //         $query->where('kode','like','%'. $search.'%')
    //         ->orWhere('kategori','like','%'. $search.'%');
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

    public function produk()
    {
        return $this->hasMany(produk::class);
    }



    //user ->oleh laravel user_id, ganti author_id
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
