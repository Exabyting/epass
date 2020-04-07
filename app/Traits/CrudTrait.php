<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 10/21/18
 * Time: 5:07 PM
 */

namespace App\Traits;


use App\Repositories\AbstractBaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Trait CrudTrait
 * @package App\Traits
 */
trait CrudTrait
{
    /**
     * Instance that extends App\Repositories\AbstractBaseRepository;
     *
     * @var AbstractBaseRepository
     */
    private $actionRepository;


    /**
     * @param AbstractBaseRepository $actionRepository
     */
    public function setActionRepository(AbstractBaseRepository $actionRepository): void
    {
        $this->actionRepository = $actionRepository;
    }


    /**
     * @param $id
     * @param null $relation
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findOne($id, $relation = null)
    {
       return $this->actionRepository->findOne($id, $relation);
    }


    /**
     * @param null $perPage
     * @param null $relation
     * @param array|null $orderBy
     * @return \App\Repositories\Contracts\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function findAll($perPage = null, $relation = null, array $orderBy = null)
    {
        return $this->actionRepository->findAll($perPage, $relation, $orderBy);
    }

    /**
     * @param array $searchCriteria
     * @param null $relation
     * @param array|null $orderBy
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findBy(array $searchCriteria = [], $relation = null, array $orderBy = null)
    {
        return $this->actionRepository->findBy($searchCriteria, $relation, $orderBy);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model|mixed
     */
    public function update(Model $model, array $data)
    {
        return $this->actionRepository->update($model, $data);
    }


    /**
     * @param $id
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete($id)
    {
        $model = $this->actionRepository->findOrFail($id);
        return $model->delete();
    }


    /**
     * @param $id
     * @param null $relation
     * @param array|null $orderBy
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Model[]|mixed
     */
    public function findOrFail($id, $relation = null, array $orderBy = null)
    {
       return $this->actionRepository->findOrFail($id);
    }


    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        return $this->actionRepository->save($data);
    }
}
