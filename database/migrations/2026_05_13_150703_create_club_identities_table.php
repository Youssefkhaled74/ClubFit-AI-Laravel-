<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_identities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->text('football_philosophy')->nullable();
            $table->string('business_model')->nullable();
            $table->boolean('prefers_youth')->default(false);
            $table->boolean('prefers_experience')->default(false);
            $table->boolean('resale_focus')->default(false);
            $table->string('star_player_policy')->nullable();
            $table->string('local_player_policy')->nullable();
            $table->boolean('multi_position_preference')->default(false);
            $table->string('risk_appetite')->default('balanced');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_identities'); }
};
