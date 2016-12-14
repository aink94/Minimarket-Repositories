<?php

namespace App\Model;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Pegawai extends Model implements Transformable, Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use TransformableTrait;
    protected $table = 'pegawai';
    protected $fillable = ['nama', 'username', 'password', 'status'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function produkmasuks()
    {
        return $this->hasMany(ProdukMasuk::class, 'user_id');
    }

    public function produkkeluars()
    {
        return $this->belongsTo(ProdukKeluar::class, 'user_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'user_id');
    }
}
