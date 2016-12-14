<?php

namespace App\Presenters;

use App\Transformers\ProdukKeluarTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukKeluarPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukKeluarPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukKeluarTransformer();
    }
}
