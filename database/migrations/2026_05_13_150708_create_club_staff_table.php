<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_staff', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('role');
            $table->string('email')->nullable();
            $table->boolean('can_approve_reports')->default(false);
            $table->boolean('can_create_players')->default(false);
            $table->boolean('can_view_financials')->default(false);
            $table->boolean('can_view_medical')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_staff'); }
};
