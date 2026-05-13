<?php

namespace Database\Seeders;

use App\Models\AnalysisReport;
use App\Models\Club;
use App\Models\ClubProfile;
use App\Models\Player;
use App\Models\User;
use App\Services\FitAnalysisService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(['email' => 'admin@clubfit.ai'], ['name' => 'Admin Analyst', 'password' => Hash::make('password'), 'role' => 'admin']);
        User::firstOrCreate(['email' => 'manager@clubfit.ai'], ['name' => 'Club Manager', 'password' => Hash::make('password'), 'role' => 'club manager']);
        User::firstOrCreate(['email' => 'scout@clubfit.ai'], ['name' => 'Scout User', 'password' => Hash::make('password'), 'role' => 'scout']);
        User::firstOrCreate(['email' => 'coach@clubfit.ai'], ['name' => 'Coach User', 'password' => Hash::make('password'), 'role' => 'coach']);

        $club = Club::create([
            'name' => 'Cairo Falcons FC', 'country' => 'Egypt', 'league' => 'Egyptian Premier League', 'season' => '2026/27',
            'logo' => 'https://example.com/falcons-logo.png', 'primary_color' => '#0F172A', 'secondary_color' => '#06B6D4',
            'currency' => 'EUR', 'club_level' => 'professional', 'created_by' => $admin->id,
        ]);

        $club->identity()->create([
            'football_philosophy' => 'High-energy proactive football with vertical transitions.',
            'business_model' => 'balanced_growth', 'prefers_youth' => true, 'prefers_experience' => true,
            'resale_focus' => true, 'star_player_policy' => 'One marquee player max', 'local_player_policy' => 'Minimum 40% local core',
            'multi_position_preference' => true, 'risk_appetite' => 'balanced',
        ]);

        $club->tacticalProfile()->create([
            'primary_formation' => '4-3-3', 'secondary_formation' => '4-2-3-1', 'attacking_shape' => '2-3-5', 'defensive_shape' => '4-4-2',
            'pressing_style' => 'high', 'build_up_style' => 'short_progressive', 'tempo' => 78, 'directness' => 64,
            'possession_target' => 58, 'width_preference' => 72, 'counter_attack_preference' => true, 'crossing_preference' => 61,
            'set_piece_importance' => 68, 'passing_risk_level' => 66, 'defensive_line_height' => 74,
        ]);

        $club->financialRule()->create([
            'total_transfer_budget' => 55000000, 'max_transfer_fee' => 30000000, 'max_salary' => 140000,
            'max_signing_bonus' => 2500000, 'max_agent_fee' => 1500000, 'max_contract_years' => 5,
            'salary_cap_enabled' => true, 'squad_cost_limit_percentage' => 72, 'accepts_loans' => true,
            'accepts_option_to_buy' => true, 'accepts_obligation_to_buy' => false, 'accepts_sell_on_clause' => true,
            'financial_risk_tolerance' => 'balanced',
        ]);

        $club->recruitmentPolicy()->create([
            'min_age' => 19, 'max_age' => 28, 'preferred_nationalities' => ['Egyptian', 'Moroccan'], 'blocked_nationalities' => [],
            'preferred_leagues' => ['EPL Egypt', 'Botola'], 'blocked_leagues' => [], 'min_experience_level' => 'first_team_regular',
            'requires_international_experience' => false, 'requires_european_experience' => false, 'language_preference' => 'Arabic/English',
            'resale_potential_min' => 65, 'foreign_player_slots_available' => 4, 'homegrown_requirement' => 6,
        ]);

        $club->medicalPolicy()->create([
            'injury_risk_tolerance' => 35, 'max_injuries_last_2_seasons' => 3, 'max_days_missed_last_2_seasons' => 120,
            'accepts_acl_history' => false, 'accepts_recurring_muscle_injuries' => false, 'min_minutes_last_season' => 1200,
            'fitness_priority' => 'high', 'medical_review_required' => true,
        ]);

        $club->squadNeeds()->createMany([
            ['position' => 'ST', 'need_level' => 'critical', 'required_role' => 'Pressing finisher', 'priority' => 'p1', 'current_players_count' => 1, 'average_age' => 31, 'quality_level' => 62, 'needs_starter' => true, 'needs_backup' => false, 'needs_future_prospect' => true, 'replace_departing_player' => true],
            ['position' => 'CB', 'need_level' => 'high', 'required_role' => 'Ball-playing defender', 'priority' => 'p1', 'current_players_count' => 2, 'average_age' => 30, 'quality_level' => 68, 'needs_starter' => true, 'needs_backup' => true, 'needs_future_prospect' => false, 'replace_departing_player' => false],
        ]);

        $club->teamMetrics()->create([
            'season' => '2025/26', 'goals_scored' => 57, 'goals_conceded' => 34, 'xg' => 55.8, 'xga' => 36.4, 'xa' => 39.7,
            'shots_per_match' => 13.8, 'shots_on_target_per_match' => 5.3, 'possession_percentage' => 56.4, 'pass_accuracy' => 84.1,
            'progressive_passes' => 842, 'final_third_entries' => 612, 'box_entries' => 341, 'ppda' => 8.7,
            'high_turnovers' => 192, 'successful_counter_attacks' => 43, 'cross_accuracy' => 27.1, 'set_piece_goals' => 11,
        ]);

        $club->staff()->createMany([
            ['name' => 'Omar Hassan', 'role' => 'Sporting Director', 'email' => 'director@falcons.ai', 'can_approve_reports' => true, 'can_create_players' => true, 'can_view_financials' => true, 'can_view_medical' => true],
            ['name' => 'Nour Salem', 'role' => 'Head Scout', 'email' => 'scout@falcons.ai', 'can_approve_reports' => false, 'can_create_players' => true, 'can_view_financials' => false, 'can_view_medical' => false],
        ]);

        $club->contractRule()->create([
            'max_contract_years' => 5, 'min_contract_years' => 2, 'release_clause_policy' => 'Mandatory for high-potential signings',
            'bonus_policy' => 'Performance weighted', 'image_rights_policy' => 'Shared by default', 'sell_on_policy' => '15-20% preferred',
            'buy_back_policy' => 'Case-by-case', 'loan_policy' => 'Young players can be loaned for development', 'agent_fee_policy' => 'Cap at 8% of gross package',
        ]);

        $club->marketStrategy()->create([
            'strategy_type' => 'undervalued_growth', 'target_regions' => ['North Africa', 'West Africa'], 'target_countries' => ['Egypt', 'Morocco', 'Tunisia'],
            'target_leagues' => ['Egyptian Premier League', 'Botola'], 'market_value_range_min' => 500000, 'market_value_range_max' => 12000000,
            'preferred_deal_type' => 'buy_with_sell_on', 'undervalued_player_focus' => true, 'free_agent_focus' => true, 'loan_market_focus' => true,
        ]);

        $legacyClub = ClubProfile::create([
            'user_id' => $admin->id, 'club_name' => 'Cairo Falcons FC', 'formation' => '4-3-3', 'playing_style' => 'high pressing',
            'budget' => 55000000, 'salary_limit' => 150000, 'needed_positions' => ['ST', 'CM', 'CB'], 'age_min' => 19, 'age_max' => 28, 'injury_tolerance' => 35,
        ]);

        $players = collect([
            ['name' => 'Karim Adel', 'age' => 23, 'position' => 'ST', 'market_value' => 32000000, 'salary' => 95000, 'contract_years' => 4, 'goals' => 21, 'assists' => 7, 'passing_accuracy' => 82, 'pressing_score' => 88, 'minutes_played' => 2980, 'injury_history' => 20],
            ['name' => 'Nader Emad', 'age' => 29, 'position' => 'CB', 'market_value' => 28000000, 'salary' => 125000, 'contract_years' => 3, 'goals' => 2, 'assists' => 1, 'passing_accuracy' => 91, 'pressing_score' => 74, 'minutes_played' => 3320, 'injury_history' => 42],
        ])->map(fn ($data) => Player::create($data));

        $service = app(FitAnalysisService::class);
        foreach ($players as $player) {
            AnalysisReport::create($service->analyze($legacyClub, $player) + ['club_profile_id' => $legacyClub->id, 'player_id' => $player->id, 'user_id' => $admin->id]);
        }
    }
}
