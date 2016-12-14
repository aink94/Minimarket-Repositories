<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdukKategoriRepository;
use App\Model\ProdukKategori;
use App\Validators\ProdukKategoriValidator;

/**
 * Class ProdukKategoriRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProdukKategoriRepositoryEloquent extends BaseRepository implements ProdukKategoriRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdukKategori::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProdukKategoriValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
