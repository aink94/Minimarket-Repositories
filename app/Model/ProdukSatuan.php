<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdukSatuan extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'produk_satuan';
    public $timestamps = false;
    protected $fillable = ['nama', 'keterangan'];

    public function produks()
    {
        return $this->hasMany(Produk::class, 'satuan_id');
    }
}
