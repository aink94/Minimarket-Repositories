<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class TransaksiDetail extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'transaksi_detail';
    public $timestamps = false;
    protected $fillable = ['produk_id', 'transaksi_id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
}
