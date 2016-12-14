<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Model\TransaksiDetail;

/**
 * Class TransaksiDetailTransformer
 * @package namespace App\Transformers;
 */
class TransaksiDetailTransformer extends TransformerAbstract
{

    /**
     * Transform the \TransaksiDetail entity
     * @param \TransaksiDetail $model
     *
     * @return array
     */
    public function transform(TransaksiDetail $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
