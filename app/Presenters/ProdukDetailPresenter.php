<?php

namespace App\Presenters;

use App\Transformers\ProdukDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukDetailPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukDetailTransformer();
    }
}
