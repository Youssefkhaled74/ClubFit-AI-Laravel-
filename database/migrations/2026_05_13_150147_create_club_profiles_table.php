<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('club_name');
            $table->string('formation');
            $table->string('playing_style');
            $table->decimal('budget', 12, 2);
            $table->decimal('salary_limit', 12, 2);
            $table->json('needed_positions');
            $table->unsignedTinyInteger('age_min');
            $table->unsignedTinyInteger('age_max');
            $table->unsignedTinyInteger('injury_tolerance')->default(50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_profiles');
    }
};
