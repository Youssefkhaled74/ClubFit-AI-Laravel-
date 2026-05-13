<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClubFinancialRule extends Model
{
    protected $fillable = ['club_id','total_transfer_budget','max_transfer_fee','max_salary','max_signing_bonus','max_agent_fee','max_contract_years','salary_cap_enabled','squad_cost_limit_percentage','accepts_loans','accepts_option_to_buy','accepts_obligation_to_buy','accepts_sell_on_clause','financial_risk_tolerance'];
    public function club(): BelongsTo { return $this->belongsTo(Club::class); }
}
