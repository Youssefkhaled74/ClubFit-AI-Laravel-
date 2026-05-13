<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_tactical_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('primary_formation')->nullable();
            $table->string('secondary_formation')->nullable();
            $table->string('attacking_shape')->nullable();
            $table->string('defensive_shape')->nullable();
            $table->string('pressing_style')->default('mid_block');
            $table->string('build_up_style')->nullable();
            $table->unsignedTinyInteger('tempo')->default(50);
            $table->unsignedTinyInteger('directness')->default(50);
            $table->unsignedTinyInteger('possession_target')->default(50);
            $table->unsignedTinyInteger('width_preference')->default(50);
            $table->boolean('counter_attack_preference')->default(false);
            $table->unsignedTinyInteger('crossing_preference')->default(50);
            $table->unsignedTinyInteger('set_piece_importance')->default(50);
            $table->unsignedTinyInteger('passing_risk_level')->default(50);
            $table->unsignedTinyInteger('defensive_line_height')->default(50);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_tactical_profiles'); }
};
