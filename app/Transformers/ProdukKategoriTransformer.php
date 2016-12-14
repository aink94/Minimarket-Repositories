<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\ProdukKategori;

/**
 * Class ProdukKategoriTransformer
 * @package namespace App\Transformers;
 */
class ProdukKategoriTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukKategori entity
     * @param \ProdukKategori $model
     *
     * @return array
     */
    public function transform(ProdukKategori $model)
    {
        return [
            'nama'      => $model->nama,
            'keterangan'=> $model->keterangan,
            'action'   => '
                <div class="btn-group btn-group-sm pull-right">
                    <button class="btn btn-info" data-id="'.$model->id.'" id="btn-ubah"><i class="fa fa-pencil"></i> </button>
                    <button class="btn btn-danger" data-id="'.$model->id.'" id="btn-hapus"><i class="fa fa-trash"></i> </button>
                </div>
            ',
        ];
    }
}
