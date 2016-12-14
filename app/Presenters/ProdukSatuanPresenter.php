<?php

namespace App\Presenters;

use App\Transformers\ProdukSatuanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukSatuanPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukSatuanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukSatuanTransformer();
    }
}
