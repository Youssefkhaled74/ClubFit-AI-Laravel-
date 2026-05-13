<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_medical_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('injury_risk_tolerance')->default(40);
            $table->unsignedTinyInteger('max_injuries_last_2_seasons')->default(3);
            $table->unsignedSmallInteger('max_days_missed_last_2_seasons')->default(120);
            $table->boolean('accepts_acl_history')->default(false);
            $table->boolean('accepts_recurring_muscle_injuries')->default(false);
            $table->unsignedInteger('min_minutes_last_season')->default(1000);
            $table->string('fitness_priority')->default('high');
            $table->boolean('medical_review_required')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_medical_policies'); }
};
