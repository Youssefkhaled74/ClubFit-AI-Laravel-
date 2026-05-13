<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_recruitment_policies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('min_age')->default(18);
            $table->unsignedTinyInteger('max_age')->default(32);
            $table->json('preferred_nationalities')->nullable();
            $table->json('blocked_nationalities')->nullable();
            $table->json('preferred_leagues')->nullable();
            $table->json('blocked_leagues')->nullable();
            $table->string('min_experience_level')->nullable();
            $table->boolean('requires_international_experience')->default(false);
            $table->boolean('requires_european_experience')->default(false);
            $table->string('language_preference')->nullable();
            $table->unsignedTinyInteger('resale_potential_min')->default(50);
            $table->unsignedTinyInteger('foreign_player_slots_available')->default(3);
            $table->unsignedTinyInteger('homegrown_requirement')->default(4);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_recruitment_policies'); }
};
