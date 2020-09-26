<?php


namespace App\Repositories;

use App\Models\Participant as Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class ParticipantRepository
 * @package App\Repositories
 */
class ParticipantRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $conferenceId
     * @param null $perPage
     * @return LengthAwarePaginator
     */
    public function getConferenceParticipants(int $conferenceId, $perPage = null)
    {
        $columns = implode(',', [
            'participants.id',
            'CONCAT (first_name, " ", last_name) as full_name',
            'departments.name as department_name'
        ]);
        $result = $this->startConditions()
            ->selectRaw($columns)
            ->leftJoin('departments', 'departments.id', '=', 'participants.department_id')
            ->where('conference_id', $conferenceId)
            ->paginate($perPage, $columns);
        return $result;
    }
}
