<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ConferenceRepository;
use function PHPUnit\Framework\isInstanceOf;

class HomeController extends Controller
{
    /**
     * @var ConferenceRepository
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $conferenceId = $this->conferenceRepository->getNearestConferenceId();
        $conferenceId ??= $this->conferenceRepository->getLastConferenceId();
        return redirect()->route('conference.show', $conferenceId);
    }
}
