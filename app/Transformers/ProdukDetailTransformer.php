<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\ProdukDetail;

/**
 * Class ProdukDetailTransformer
 * @package namespace App\Transformers;
 */
class ProdukDetailTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProdukDetail entity
     * @param \ProdukDetail $model
     *
     * @return array
     */
    public function transform(ProdukDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
