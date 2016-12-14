<?php

namespace App\Presenters;

use App\Transformers\SupplierTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SupplierPresenter
 *
 * @package namespace App\Presenters;
 */
class SupplierPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SupplierTransformer();
    }
}
