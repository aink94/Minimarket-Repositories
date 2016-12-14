<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdukKeluarRepository;
use App\Model\ProdukKeluar;
use App\Validators\ProdukKeluarValidator;

/**
 * Class ProdukKeluarRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProdukKeluarRepositoryEloquent extends BaseRepository implements ProdukKeluarRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdukKeluar::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProdukKeluarValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
