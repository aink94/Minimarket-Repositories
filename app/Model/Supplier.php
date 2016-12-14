<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Supplier extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'supplier';
    protected $fillable = ['nama', 'alamat', 'telepon', 'deskripsi'];

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'supplier_id');
    }
}
