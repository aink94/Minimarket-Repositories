<?php
/**
 * Created by PhpStorm.
 * User: Faisal Abdul Hamid
 * Date: 13/12/2016
 * Time: 14:44
 */

namespace App\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrderByStokDescCriteria implements CriteriaInterface
{

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->orderBy('stok', 'desc');
        return $model;
    }
}