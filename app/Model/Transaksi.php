<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Transaksi extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'transaksi';
    public $timestamps = false;
    protected $fillable = ['kode', 'tanggal', 'pelanggan_id', 'pegawai_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function transaksidetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksi', 'transaksi_id', 'produk_id');
    }
}
