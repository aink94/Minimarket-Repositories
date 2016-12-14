<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\ProdukMasuk;

/**
 * Class ProdukMasukTransformer
 * @package namespace App\Transformers;
 */
class ProdukMasukTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukMasuk entity
     * @param \ProdukMasuk $model
     *
     * @return array
     */
    public function transform(ProdukMasuk $model)
    {
        return [
            'tanggal' => $model->tanggal,
            'kode' => $model->produk->kode,
            'nama' => $model->produk->nama,
            'detail' => $model->produkdetail->nama,
            'stok' => $model->stok,
            'supplier' => ($model->supplier) ? $model->supplier->nama : NULL,
        ];
    }
}
