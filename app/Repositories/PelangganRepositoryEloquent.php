<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PelangganRepository;
use App\Model\Pelanggan;
use App\Validators\PelangganValidator;

/**
 * Class PelangganRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PelangganRepositoryEloquent extends BaseRepository implements PelangganRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pelanggan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PelangganValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
