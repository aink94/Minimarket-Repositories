<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\Pelanggan;

/**
 * Class PelangganTransformer
 * @package namespace App\Transformers;
 */
class PelangganTransformer extends TransformerAbstract
{

    /**
     * Transform the \Pelanggan entity
     * @param \Pelanggan $model
     *
     * @return array
     */
    public function transform(Pelanggan $model)
    {
        return [
            'nama' => $model->nama,
            'jenis_kelamin' => $model->jenis_kelamin,
            'telepon' => $model->telepon,
            'alamat' => $model->alamat,
            'action'   => '
                <div class="btn-group btn-group-sm pull-right">
                    <button class="btn btn-info" data-id="'.$model->id.'" id="btn-ubah"><i class="fa fa-pencil"></i> </button>
                    <button class="btn btn-danger" data-id="'.$model->id.'" id="btn-hapus"><i class="fa fa-trash"></i> </button>
                </div>
            ',
        ];
    }
}
