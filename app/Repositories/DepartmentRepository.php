<?php


namespace App\Repositories;

use App\Models\Department as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DepartmentRepository
 * @package App\Repositories
 */
class DepartmentRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param $id
     * @return Model
     */
    public function getItem($id)
    {
        return $this->startConditions()->findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function getList()
    {
        $columns = [
            'id',
            'name'];
        $result = $this->startConditions()
            ->select($columns)
            ->toBase()
            ->get();
        return $result;
    }
}
