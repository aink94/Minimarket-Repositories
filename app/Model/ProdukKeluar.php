<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdukKeluar extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'produk_keluar';
    public $timestamps = false;
    protected $fillable = ['tanggal', 'stok', 'produk_id', 'produk_detail_id', 'pegawai_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function produkdetail()
    {
        return $this->belongsTo(ProdukDetail::class, 'produk_detail_id');
    }
}
