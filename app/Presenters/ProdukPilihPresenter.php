<?php

namespace App\Presenters;

use App\Transformers\ProdukPilihTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukPilihPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukPilihPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukPilihTransformer();
    }
}
