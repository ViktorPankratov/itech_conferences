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
}
