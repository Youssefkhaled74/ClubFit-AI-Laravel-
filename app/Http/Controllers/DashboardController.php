<?php

namespace App\Http\Controllers;

use App\Models\AnalysisReport;
use App\Models\Player;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalPlayers = Player::count();
        $totalReports = AnalysisReport::count();
        $averageFitScore = round((float) AnalysisReport::avg('final_fit_score'), 2);
        $recommendedPlayers = AnalysisReport::with('player')->where('final_fit_score', '>=', 75)->latest()->take(5)->get();

        return view('dashboard', compact('totalPlayers', 'totalReports', 'averageFitScore', 'recommendedPlayers'));
    }
}
