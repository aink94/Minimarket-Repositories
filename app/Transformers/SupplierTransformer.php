<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Supplier;

/**
 * Class SupplierTransformer
 * @package namespace App\Transformers;
 */
class SupplierTransformer extends TransformerAbstract
{

    /**
     * Transform the \Supplier entity
     * @param \Supplier $model
     *
     * @return array
     */
    public function transform(Supplier $model)
    {
        return [
            'nama' => $model->nama,
            'telepon' => $model->telepon,
            'alamat' => $model->alamat,
            'deskripsi' => $model->deskripsi,
            'action'   => '
                <div class="btn-group btn-group-sm pull-right">
                    <button class="btn btn-info" data-id="'.$model->id.'" id="btn-ubah"><i class="fa fa-pencil"></i> </button>
                    <button class="btn btn-danger" data-id="'.$model->id.'" id="btn-hapus"><i class="fa fa-trash"></i> </button>
                </div>
            ',
        ];
    }
}
