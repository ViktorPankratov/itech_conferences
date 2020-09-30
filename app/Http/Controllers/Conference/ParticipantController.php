<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Participant;
use App\Repositories\ParticipantRepository;
use App\Repositories\DepartmentRepository;
use App\Repositories\ConferenceRepository;
use App\Http\Requests\ConferenceParticipantCreateRequest;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * @var ParticipantRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $participantRepository;

    /**
     * @var DepartmentRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $departmentRepository;

    /**
     * @var ConferenceRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $conferenceRepository;

    /**
     * ParticipantController constructor.
     */
    public function __construct()
    {
        $this->participantRepository = app(ParticipantRepository::class);
        $this->conferenceRepository = app(ConferenceRepository::class);
        $this->departmentRepository = app(DepartmentRepository::class);
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($conferenceId)
    {
        $conferenceDetail = $this->conferenceRepository->getItem($conferenceId);
        $participantPaginator = $this->participantRepository->getConferenceParticipants($conferenceId, 10);
        return view('conference.participants.index',
            compact(['conferenceDetail', 'participantPaginator']));
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($conferenceId)
    {
        $conferenceDetail = $this->conferenceRepository->getItem($conferenceId);
        if(empty($conferenceDetail)){
            abort(404);
        }
        $participant = new Participant();
        $departmentList = $this->departmentRepository->getList();
        return view('conference.participants.create',
            compact(['participant', 'conferenceDetail', 'departmentList']));
    }

    /**
     * @param ConferenceParticipantCreateRequest $request
     * @param $conferenceId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConferenceParticipantCreateRequest $request, $conferenceId)
    {
        $data = $request->input();
        $data['participant']['conference_id'] = $conferenceId;
        $participantResult = (new Participant())->create($data['participant']);

        $lectureResult = true;
        if (isset($data['with_lecture'])){
            $data['lecture']['participant_id'] = $participantResult->id;
            $data['lecture']['conference_id'] = $conferenceId;
            $lectureResult = (new Lecture())->create($data['lecture']);
        }

        if ($participantResult && $lectureResult) {
            $this->sendBitrix24($data);
            return redirect()->route('conference.show', $conferenceId)
                ->with(['participant_save_success' => __("Successfully registered for conference")]);
        } else {
            return back()
                ->withErrors(['msg' => __('Record save error')])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $data
     */
    protected function sendBitrix24($data)
    {
        $queryUrl = 'https://b24-avi8zs.bitrix24.ru/rest/1/z1xpt1zgey2e7ce5/crm.lead.add.json';

        $participantDepartment = $this->departmentRepository->getItem($data['participant']['department_id']);
        $conference = $this->conferenceRepository->getItem($data['participant']['conference_id']);
        $queryData = http_build_query(array(
            'fields' => array(
                'TITLE'       => 'Заявка от ' . $data['participant']['first_name'] . ' ' . $data['participant']['last_name'],
                'NAME'        => $data['participant']['first_name'],
                'SECOND_NAME' => $data['participant']['last_name'],
                'EMAIL' => Array(
                    "n0" => Array(
                        "VALUE"      => $data['participant']['email_address'],
                        "VALUE_TYPE" => "WORK",
                    ),
                ),
                'PHONE' => Array(
                    "n0" => Array(
                        "VALUE"      => $data['participant']['phone_number'],
                        "VALUE_TYPE" => "WORK",
                    ),
                ),
                'COMPANY_TITLE'       => $participantDepartment->name,
                'COMMENTS'            => $conference->name . "<br>" .
                                         $data['lecture']['title'] ??= "",
                'SOURCE_DESCRIPTION'  => 'CRM-форма'
            ),
            'params' => array("REGISTER_SONET_EVENT" => "Y")
        ));

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_POST           => 1,
            CURLOPT_HEADER         => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL            => $queryUrl,
            CURLOPT_POSTFIELDS     => $queryData,
        ));
        curl_exec($curl);
        curl_close($curl);
    }
}
