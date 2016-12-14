<?php

namespace App\Presenters;

use App\Transformers\ProdukKategoriTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdukKategoriPresenter
 *
 * @package namespace App\Presenters;
 */
class ProdukKategoriPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdukKategoriTransformer();
    }
}
