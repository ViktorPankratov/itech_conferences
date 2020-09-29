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
