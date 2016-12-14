<?php

namespace App\Presenters;

use App\Transformers\PelangganTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PelangganPresenter
 *
 * @package namespace App\Presenters;
 */
class PelangganPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PelangganTransformer();
    }
}
