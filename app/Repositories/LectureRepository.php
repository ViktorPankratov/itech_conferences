<?php


namespace App\Repositories;

use App\Models\Lecture as Model;

/**
 * Class LectureRepository
 * @package App\Repositories
 */
class LectureRepository extends CoreRepository
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
        return $this->startConditions()->find($id);
    }
}
