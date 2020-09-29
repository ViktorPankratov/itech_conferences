<?php

namespace App\Http\Controllers\Conference;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LectureRepository;

/**
 * Class LectureController
 * @package App\Http\Controllers\Conference
 */
class LectureController extends Controller
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application|mixed|LectureRepository
     */
    protected $lectureRepository;

    /**
     * LectureController constructor.
     */
    public function __construct()
    {
        $this->lectureRepository = app(LectureRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($conferenceId)
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
        $lectureItem = $this->lectureRepository->getItem($id);
        return view('conference.lectures.show',
            compact('lectureItem'));
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
