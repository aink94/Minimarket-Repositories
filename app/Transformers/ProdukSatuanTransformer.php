<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\ProdukSatuan;

/**
 * Class ProdukSatuanTransformer
 * @package namespace App\Transformers;
 */
class ProdukSatuanTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukSatuan entity
     * @param \ProdukSatuan $model
     *
     * @return array
     */
    public function transform(ProdukSatuan $model)
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
