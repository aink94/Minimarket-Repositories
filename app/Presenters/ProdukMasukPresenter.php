<?php

namespace App\Presenters;

use App\Transformers\ProdukMasukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukMasukPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukMasukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukMasukTransformer();
    }
}
