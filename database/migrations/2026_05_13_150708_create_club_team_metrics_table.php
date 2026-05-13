<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_team_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('season');
            $table->unsignedSmallInteger('goals_scored')->default(0);
            $table->unsignedSmallInteger('goals_conceded')->default(0);
            $table->decimal('xg', 8, 2)->default(0);
            $table->decimal('xga', 8, 2)->default(0);
            $table->decimal('xa', 8, 2)->default(0);
            $table->decimal('shots_per_match', 5, 2)->default(0);
            $table->decimal('shots_on_target_per_match', 5, 2)->default(0);
            $table->decimal('possession_percentage', 5, 2)->default(0);
            $table->decimal('pass_accuracy', 5, 2)->default(0);
            $table->unsignedSmallInteger('progressive_passes')->default(0);
            $table->unsignedSmallInteger('final_third_entries')->default(0);
            $table->unsignedSmallInteger('box_entries')->default(0);
            $table->decimal('ppda', 5, 2)->default(0);
            $table->unsignedSmallInteger('high_turnovers')->default(0);
            $table->unsignedSmallInteger('successful_counter_attacks')->default(0);
            $table->decimal('cross_accuracy', 5, 2)->default(0);
            $table->unsignedSmallInteger('set_piece_goals')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_team_metrics'); }
};
