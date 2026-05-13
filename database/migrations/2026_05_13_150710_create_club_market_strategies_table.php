<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_market_strategies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('strategy_type')->nullable();
            $table->json('target_regions')->nullable();
            $table->json('target_countries')->nullable();
            $table->json('target_leagues')->nullable();
            $table->decimal('market_value_range_min', 14, 2)->default(0);
            $table->decimal('market_value_range_max', 14, 2)->default(0);
            $table->string('preferred_deal_type')->nullable();
            $table->boolean('undervalued_player_focus')->default(false);
            $table->boolean('free_agent_focus')->default(false);
            $table->boolean('loan_market_focus')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_market_strategies'); }
};
