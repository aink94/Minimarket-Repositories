<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pelanggan extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'pelanggan';
    protected $fillable = ['nama', 'jenis_kelamin', 'telepon', 'alamat'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'pelanggan_id');
    }
}
