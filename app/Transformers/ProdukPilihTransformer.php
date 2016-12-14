<?php

namespace App\Transformers;

use App\Model\Produk;
use League\Fractal\TransformerAbstract;

/**
 * Class ProdukPilihTransformer
 * @package namespace App\Transformers;
 */
class ProdukPilihTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukPilih entity
     * @param \ProdukPilih $model
     *
     * @return array
     */
    public function transform(Produk $model)
    {
        return [
            'kode' => $model->kode,
            'nama' => $model->nama,
            'harga' => $model->harga,
            'stok' => $model->stok,
            'pilih' => '<button class="btn btn-sm btn-info pull-right" onClick="pilih('.$model->kode.', '.$model->stok.')"><i class="fa fa-arrow-down"></i> </button>',
        ];
    }
}
