<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\ProdukKeluar;

/**
 * Class ProdukKeluarTransformer
 * @package namespace App\Transformers;
 */
class ProdukKeluarTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukKeluar entity
     * @param \ProdukKeluar $model
     *
     * @return array
     */
    public function transform(ProdukKeluar $model)
    {
        return [
            'tanggal' => $model->tanggal,
            'kode' => $model->produk->kode,
            'nama' => $model->produk->nama,
            'detail' => $model->produkdetail->nama,
            'stok' => $model->stok,
        ];
    }
}
