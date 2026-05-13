<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_squad_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('position');
            $table->string('need_level')->default('medium');
            $table->string('required_role')->nullable();
            $table->string('priority')->default('p2');
            $table->unsignedTinyInteger('current_players_count')->default(0);
            $table->unsignedTinyInteger('average_age')->default(25);
            $table->unsignedTinyInteger('quality_level')->default(50);
            $table->boolean('needs_starter')->default(false);
            $table->boolean('needs_backup')->default(false);
            $table->boolean('needs_future_prospect')->default(false);
            $table->boolean('replace_departing_player')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_squad_needs'); }
};
