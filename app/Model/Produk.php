<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Produk extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'produk';
    protected $fillable = ['kode', 'nama', 'harga', 'deskripsi', 'kategori_id', 'satuan_id'];
    protected $appends = ['stok'];

    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'kategori_id');
    }

    public function satuan()
    {
        return $this->belongsTo(ProdukSatuan::class, 'satuan_id');
    }

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'produk_id');
    }

    public function produkkeluars()
    {
        return $this->hasMany(ProdukKeluar::class, 'produk_id');
    }

    public function transaksidetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'produk_id');
    }

    public function getStokAttribute()
    {
        return intval($this->produkmasuks()->sum('stok') -  $this->produkkeluars()->sum('stok'));
    }
}
