<?php

namespace App\Services;

use App\Models\ClubProfile;
use App\Models\Player;

class FitAnalysisService
{
    public function analyze(ClubProfile $club, Player $player): array
    {
        $technicalFit = min(100, (($player->goals * 2) + ($player->assists * 1.5) + $player->passing_accuracy + $player->pressing_score) / 2.2);
        $tacticalFit = $this->tacticalFit($club, $player);
        $financialFit = $this->financialFit($club, $player);
        $medicalRisk = max(0, 100 - abs((int) $club->injury_tolerance - (int) $player->injury_history));
        $squadNeed = in_array($player->position, $club->needed_positions, true) ? 95 : 45;
        $finalFitScore = round(($technicalFit * 0.25) + ($tacticalFit * 0.25) + ($financialFit * 0.2) + ($medicalRisk * 0.15) + ($squadNeed * 0.15), 2);

        return [
            'technical_fit' => round($technicalFit, 2),
            'tactical_fit' => round($tacticalFit, 2),
            'financial_fit' => round($financialFit, 2),
            'medical_risk' => round($medicalRisk, 2),
            'squad_need' => round($squadNeed, 2),
            'final_fit_score' => $finalFitScore,
            'recommendation' => $this->recommendationText($finalFitScore, $club, $player),
        ];
    }

    private function tacticalFit(ClubProfile $club, Player $player): float
    {
        $styleMap = [
            'high pressing' => $player->pressing_score,
            'possession' => $player->passing_accuracy,
            'counter attack' => min(100, ($player->minutes_played / 40) + $player->goals + $player->assists),
        ];

        $styleScore = $styleMap[strtolower($club->playing_style)] ?? 60;
        $formationBoost = str_contains($club->formation, '4-3-3') && in_array($player->position, ['RW', 'LW', 'ST'], true) ? 10 : 0;

        return min(100, $styleScore + $formationBoost);
    }

    private function financialFit(ClubProfile $club, Player $player): float
    {
        $budgetScore = $player->market_value <= $club->budget ? 100 : max(10, 100 - (($player->market_value - $club->budget) / max(1, $club->budget) * 100));
        $salaryScore = $player->salary <= $club->salary_limit ? 100 : max(5, 100 - (($player->salary - $club->salary_limit) / max(1, $club->salary_limit) * 100));

        return ($budgetScore * 0.65) + ($salaryScore * 0.35);
    }

    private function recommendationText(float $score, ClubProfile $club, Player $player): string
    {
        if ($score >= 80) {
            return "Strong fit: {$player->name} aligns well with {$club->club_name} tactical model and financial frame. Prioritize shortlist and open negotiation.";
        }

        if ($score >= 60) {
            return "Conditional fit: {$player->name} offers value, but trade-offs exist. Proceed if price and wage terms can be optimized.";
        }

        return "Low fit: {$player->name} has meaningful mismatch with {$club->club_name} requirements. Monitor only if market conditions shift.";
    }
}
