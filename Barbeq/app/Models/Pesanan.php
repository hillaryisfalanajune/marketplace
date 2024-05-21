<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    // protected $with = ['user', 'produk', 'statusverifikasi', 'rekening'];
    protected $fillable = [
        'pembeli_id',
        'kode',
        'alamat',
        'produk_id',
        'user_id',
        'cara_bayar',
        'bukti_transfer',
        'statusverifikasi_id',
        'status_id',
        'rekening_id'
    ];

    public function statusverifikasi()
    {
        return $this->belongsTo(Statusverifikasi::class);
    }

    public function norekening()
    {
        return $this->belongsTo(Rekening::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class,'pembeli_id');
    }


    public function rekening()
    {
        return $this->belongsTo(Rekening::class, 'rekening_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
