<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Produk;

/**
 * Class ProdukTransformer
 * @package namespace App\Transformers;
 */
class ProdukTransformer extends TransformerAbstract
{

    /**
     * Transform the \Produk entity
     * @param \Produk $model
     *
     * @return array
     */
    public function transform(Produk $model)
    {
        return [
            'id'       => (int) $model->id,
            'kode'     => $model->kode,
            'nama'     => $model->nama,
            'harga'    => $model->harga,
            'stok'     => $model->stok,
            'kategori' => $model->kategori->nama,
            'satuan'   => $model->satuan->nama,
            'action'   => '
                <div class="btn-group btn-group-sm pull-right">
                    <button class="btn btn-info" data-id="'.$model->id.'" id="btn-ubah"><i class="fa fa-pencil"></i> </button>
                    <button class="btn btn-danger" data-id="'.$model->id.'" id="btn-hapus"><i class="fa fa-trash"></i> </button>
                </div>
            ',
        ];
    }
}
