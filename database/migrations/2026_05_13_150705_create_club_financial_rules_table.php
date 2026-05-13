<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('club_financial_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('club_id')->unique()->constrained()->cascadeOnDelete();
            $table->decimal('total_transfer_budget', 14, 2)->default(0);
            $table->decimal('max_transfer_fee', 14, 2)->default(0);
            $table->decimal('max_salary', 14, 2)->default(0);
            $table->decimal('max_signing_bonus', 14, 2)->default(0);
            $table->decimal('max_agent_fee', 14, 2)->default(0);
            $table->unsignedTinyInteger('max_contract_years')->default(5);
            $table->boolean('salary_cap_enabled')->default(false);
            $table->unsignedTinyInteger('squad_cost_limit_percentage')->default(70);
            $table->boolean('accepts_loans')->default(true);
            $table->boolean('accepts_option_to_buy')->default(true);
            $table->boolean('accepts_obligation_to_buy')->default(false);
            $table->boolean('accepts_sell_on_clause')->default(true);
            $table->string('financial_risk_tolerance')->default('balanced');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('club_financial_rules'); }
};
