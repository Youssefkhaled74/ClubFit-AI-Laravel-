<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('age');
            $table->string('position');
            $table->decimal('market_value', 12, 2);
            $table->decimal('salary', 12, 2);
            $table->unsignedTinyInteger('contract_years');
            $table->unsignedSmallInteger('goals')->default(0);
            $table->unsignedSmallInteger('assists')->default(0);
            $table->decimal('passing_accuracy', 5, 2)->default(0);
            $table->decimal('pressing_score', 5, 2)->default(0);
            $table->unsignedInteger('minutes_played')->default(0);
            $table->unsignedTinyInteger('injury_history')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
