<?php

namespace App\Http\Controllers;

use App\Models\AnalysisReport;
use App\Models\Club;
use App\Models\ClubSquadNeed;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalClubs = Club::count();
        $totalSquadNeeds = ClubSquadNeed::count();
        $totalReports = AnalysisReport::count();
        $averageFitScore = round((float) AnalysisReport::avg('final_fit_score'), 2);

        $clubTacticalSummary = Club::with('tacticalProfile')->latest()->take(3)->get();
        $financialLimitsSummary = Club::with('financialRule')->latest()->take(3)->get();
        $topPriorityPositions = ClubSquadNeed::selectRaw('position, count(*) as total')
            ->where('priority', 'p1')
            ->groupBy('position')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalClubs',
            'totalSquadNeeds',
            'totalReports',
            'averageFitScore',
            'clubTacticalSummary',
            'financialLimitsSummary',
            'topPriorityPositions'
        ));
    }
}
