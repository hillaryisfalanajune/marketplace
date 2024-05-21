<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $guarded = ['id'];
    protected $table = 'keuangans';

    public function scopeFilter($query, array $filters){

        $query->when($filters['search'] ?? false,function($query,$search){
            return
            $query->where('id','like','%'. $search.'%')
            ->orWhere('nama_penjual','like','%'. $search.'%');
        });


        $query->when(
            //author berasal dari url yang di kirim
            $filters['author'] ?? false,
            fn ($query,$author) =>
            //author berasal dari relasi method public function author()
            $query->whereHas('author',
                fn($query) =>
                $query->where('username', $author)
            )

        );

    }


    public function user()
    {
        //Post ke Categories Relasi satu ke satu
        return $this->belongsTo(user::class);
    }
    public function pengiriman()
    {
        //Post ke Categories Relasi satu ke satu
        return $this->belongsTo(pengiriman::class);
    }

    //user ->oleh laravel user_id, ganti author_id
    public function author()
    {
        //Post ke Categories Relasi satu ke satu
        return $this->belongsTo(User::class,'user_id');
    }

    public function getRouteKeyName()
    {
        return 'kode';
    }
}
