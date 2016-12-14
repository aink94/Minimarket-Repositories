<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdukSatuanRepository;
use App\Model\ProdukSatuan;
use App\Validators\ProdukSatuanValidator;

/**
 * Class ProdukSatuanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProdukSatuanRepositoryEloquent extends BaseRepository implements ProdukSatuanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdukSatuan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProdukSatuanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
