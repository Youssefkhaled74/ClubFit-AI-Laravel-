<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnalysisReportRequest;
use App\Models\AnalysisReport;
use App\Models\ClubProfile;
use App\Models\Player;
use App\Services\FitAnalysisService;

class AnalysisReportController extends Controller
{
    public function __construct(private readonly FitAnalysisService $fitAnalysisService) {}

    public function index()
    {
        $reports = AnalysisReport::with(['clubProfile', 'player', 'user'])->latest()->paginate(10);
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create', [
            'clubs' => ClubProfile::orderBy('club_name')->get(),
            'players' => Player::orderBy('name')->get(),
        ]);
    }

    public function store(StoreAnalysisReportRequest $request)
    {
        $club = ClubProfile::findOrFail($request->validated('club_profile_id'));
        $player = Player::findOrFail($request->validated('player_id'));
        $scores = $this->fitAnalysisService->analyze($club, $player);

        $report = AnalysisReport::create($scores + [
            'club_profile_id' => $club->id,
            'player_id' => $player->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reports.show', $report)->with('success', 'Analysis generated successfully.');
    }

    public function show(AnalysisReport $report)
    {
        $report->load(['clubProfile', 'player', 'user']);
        return view('reports.show', compact('report'));
    }

    public function destroy(AnalysisReport $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted.');
    }
}
