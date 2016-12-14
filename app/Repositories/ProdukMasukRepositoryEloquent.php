<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdukMasukRepository;
use App\Model\ProdukMasuk;
use App\Validators\ProdukMasukValidator;

/**
 * Class ProdukMasukRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProdukMasukRepositoryEloquent extends BaseRepository implements ProdukMasukRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdukMasuk::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProdukMasukValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
