<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdukDetailRepository;
use App\Model\ProdukDetail;
use App\Validators\ProdukDetailValidator;

/**
 * Class ProdukDetailRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProdukDetailRepositoryEloquent extends BaseRepository implements ProdukDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdukDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProdukDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
