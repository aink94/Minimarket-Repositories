<?php

namespace App\Presenters;

use App\Transformers\ProdukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukTransformer();
    }
}
