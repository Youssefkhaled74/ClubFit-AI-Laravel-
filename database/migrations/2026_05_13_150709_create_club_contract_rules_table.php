<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_contract_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('max_contract_years')->default(5);
            $table->unsignedTinyInteger('min_contract_years')->default(2);
            $table->string('release_clause_policy')->nullable();
            $table->string('bonus_policy')->nullable();
            $table->string('image_rights_policy')->nullable();
            $table->string('sell_on_policy')->nullable();
            $table->string('buy_back_policy')->nullable();
            $table->string('loan_policy')->nullable();
            $table->string('agent_fee_policy')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_contract_rules'); }
};
