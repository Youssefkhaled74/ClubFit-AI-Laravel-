<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analysis_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('technical_fit', 5, 2);
            $table->decimal('tactical_fit', 5, 2);
            $table->decimal('financial_fit', 5, 2);
            $table->decimal('medical_risk', 5, 2);
            $table->decimal('squad_need', 5, 2);
            $table->decimal('final_fit_score', 5, 2);
            $table->text('recommendation');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analysis_reports');
    }
};
