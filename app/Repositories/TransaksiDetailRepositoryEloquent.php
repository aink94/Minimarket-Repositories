<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TransaksiDetailRepository;
use App\Model\TransaksiDetail;
use App\Validators\TransaksiDetailValidator;

/**
 * Class TransaksiDetailRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TransaksiDetailRepositoryEloquent extends BaseRepository implements TransaksiDetailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TransaksiDetail::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TransaksiDetailValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
