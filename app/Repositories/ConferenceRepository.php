<?php


namespace App\Repositories;

use App\Models\Conference as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class ConferenceRepository
 * @package App\Repositories
 */
class ConferenceRepository extends CoreRepository
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

    /**
     * @param int $conferenceId
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getConferenceLectures(int $conferenceId, $perPage = 10)
    {
        $columns = implode(',', [
            'lectures.id',
            'lectures.title',
            'CONCAT (participants.first_name, " ", participants.last_name) as participant_full_name',
            'departments.name as department_name'
        ]);
        $result = DB::table('lectures')
            ->selectRaw($columns)
            ->leftJoin('participants', 'participants.id', '=', 'lectures.participant_id')
            ->leftJoin('departments', 'departments.id', '=', 'participants.department_id')
            ->where('lectures.conference_id', $conferenceId)
            ->paginate($perPage, $columns);
        return $result;
    }
}
