<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use App\Repositories\ConferenceRepository;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * @var ConferenceRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $conferenceRepository;

    /**
     * ConferenceController constructor.
     */
    public function __construct()
    {
        $this->conferenceRepository = app(ConferenceRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $conferenceDetail = $this->conferenceRepository->getItem($id);
        $conferenceLecturesPaginator = $this->conferenceRepository->getConferenceLectures($id);
        return view('conference.conference',
            compact(['conferenceDetail', 'conferenceLecturesPaginator']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
