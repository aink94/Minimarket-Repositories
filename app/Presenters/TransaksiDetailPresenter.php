<?php

namespace App\Presenters;

use App\Transformers\TransaksiDetailTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TransaksiDetailPresenter
 *
 * @package namespace App\Presenters;
 */
class TransaksiDetailPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TransaksiDetailTransformer();
    }
}
