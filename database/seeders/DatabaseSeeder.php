<?php

namespace Database\Seeders;

use App\Models\AnalysisReport;
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
        $admin = User::create(['name' => 'Admin Analyst', 'email' => 'admin@clubfit.ai', 'password' => Hash::make('password'), 'role' => 'admin']);
        User::create(['name' => 'Club Manager', 'email' => 'manager@clubfit.ai', 'password' => Hash::make('password'), 'role' => 'club manager']);
        User::create(['name' => 'Scout User', 'email' => 'scout@clubfit.ai', 'password' => Hash::make('password'), 'role' => 'scout']);
        User::create(['name' => 'Coach User', 'email' => 'coach@clubfit.ai', 'password' => Hash::make('password'), 'role' => 'coach']);

        $club = ClubProfile::create([
            'user_id' => $admin->id,
            'club_name' => 'Cairo Falcons FC',
            'formation' => '4-3-3',
            'playing_style' => 'high pressing',
            'budget' => 55000000,
            'salary_limit' => 150000,
            'needed_positions' => ['ST', 'CM', 'CB'],
            'age_min' => 19,
            'age_max' => 28,
            'injury_tolerance' => 35,
        ]);

        $players = collect([
            ['name' => 'Karim Adel', 'age' => 23, 'position' => 'ST', 'market_value' => 32000000, 'salary' => 95000, 'contract_years' => 4, 'goals' => 21, 'assists' => 7, 'passing_accuracy' => 82, 'pressing_score' => 88, 'minutes_played' => 2980, 'injury_history' => 20],
            ['name' => 'Nader Emad', 'age' => 29, 'position' => 'CB', 'market_value' => 28000000, 'salary' => 125000, 'contract_years' => 3, 'goals' => 2, 'assists' => 1, 'passing_accuracy' => 91, 'pressing_score' => 74, 'minutes_played' => 3320, 'injury_history' => 42],
            ['name' => 'Luis Moreno', 'age' => 25, 'position' => 'CM', 'market_value' => 46000000, 'salary' => 160000, 'contract_years' => 5, 'goals' => 9, 'assists' => 14, 'passing_accuracy' => 93, 'pressing_score' => 85, 'minutes_played' => 3150, 'injury_history' => 18],
        ])->map(fn ($data) => Player::create($data));

        $service = app(FitAnalysisService::class);
        foreach ($players as $player) {
            AnalysisReport::create($service->analyze($club, $player) + ['club_profile_id' => $club->id, 'player_id' => $player->id, 'user_id' => $admin->id]);
        }
    }
}
