<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdukDetail extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'produk_detail';
    public $timestamps = false;
    protected $fillable = ['nama', 'deskripsi', 'status'];

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'detail_produk_id');
    }

    public function produkkeluars()
    {
        return $this->hasMany(ProdukKeluar::class, 'detail_produk_id');
    }
}
