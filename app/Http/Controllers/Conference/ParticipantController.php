<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Repositories\ParticipantRepository;
use App\Repositories\ConferenceRepository;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * @var ParticipantRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $participantRepository;

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
    }

    /**
     * @param $conferenceId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($conferenceId)
    {
        $conferenceDetail = $this->conferenceRepository->getItem($conferenceId);
        $participantPaginator = $this->participantRepository->getConferenceParticipants($conferenceId, 10);
        return view('conference.participants',
            compact(['conferenceDetail', 'participantPaginator']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
