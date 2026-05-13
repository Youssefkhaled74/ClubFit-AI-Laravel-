<?php

namespace App\Http\Requests;

use App\Enums\NeedLevel;
use App\Enums\NeedPriority;
use App\Enums\PressingStyle;
use App\Enums\RiskAppetite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClubRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'country' => ['required','string','max:100'],
            'league' => ['required','string','max:100'],
            'season' => ['required','string','max:20'],
            'logo' => ['nullable','url'],
            'primary_color' => ['nullable','string','max:20'],
            'secondary_color' => ['nullable','string','max:20'],
            'currency' => ['required','string','max:10'],
            'club_level' => ['required','string','max:100'],

            'identity.football_philosophy' => ['nullable','string'],
            'identity.business_model' => ['nullable','string','max:255'],
            'identity.prefers_youth' => ['boolean'],
            'identity.prefers_experience' => ['boolean'],
            'identity.resale_focus' => ['boolean'],
            'identity.star_player_policy' => ['nullable','string','max:255'],
            'identity.local_player_policy' => ['nullable','string','max:255'],
            'identity.multi_position_preference' => ['boolean'],
            'identity.risk_appetite' => ['required', Rule::enum(RiskAppetite::class)],

            'tactical.primary_formation' => ['nullable','string','max:20'],
            'tactical.secondary_formation' => ['nullable','string','max:20'],
            'tactical.attacking_shape' => ['nullable','string','max:100'],
            'tactical.defensive_shape' => ['nullable','string','max:100'],
            'tactical.pressing_style' => ['required', Rule::enum(PressingStyle::class)],
            'tactical.build_up_style' => ['nullable','string','max:100'],
            'tactical.tempo' => ['integer','between:0,100'],
            'tactical.directness' => ['integer','between:0,100'],
            'tactical.possession_target' => ['integer','between:0,100'],
            'tactical.width_preference' => ['integer','between:0,100'],
            'tactical.counter_attack_preference' => ['boolean'],
            'tactical.crossing_preference' => ['integer','between:0,100'],
            'tactical.set_piece_importance' => ['integer','between:0,100'],
            'tactical.passing_risk_level' => ['integer','between:0,100'],
            'tactical.defensive_line_height' => ['integer','between:0,100'],

            'financial.total_transfer_budget' => ['numeric','min:0'],
            'financial.max_transfer_fee' => ['numeric','min:0'],
            'financial.max_salary' => ['numeric','min:0'],
            'financial.max_signing_bonus' => ['numeric','min:0'],
            'financial.max_agent_fee' => ['numeric','min:0'],
            'financial.max_contract_years' => ['integer','between:1,10'],
            'financial.salary_cap_enabled' => ['boolean'],
            'financial.squad_cost_limit_percentage' => ['integer','between:0,100'],
            'financial.accepts_loans' => ['boolean'],
            'financial.accepts_option_to_buy' => ['boolean'],
            'financial.accepts_obligation_to_buy' => ['boolean'],
            'financial.accepts_sell_on_clause' => ['boolean'],
            'financial.financial_risk_tolerance' => ['required', Rule::enum(RiskAppetite::class)],

            'recruitment.min_age' => ['integer','between:15,40'],
            'recruitment.max_age' => ['integer','between:15,45','gte:recruitment.min_age'],
            'recruitment.preferred_nationalities' => ['nullable','array'],
            'recruitment.blocked_nationalities' => ['nullable','array'],
            'recruitment.preferred_leagues' => ['nullable','array'],
            'recruitment.blocked_leagues' => ['nullable','array'],
            'recruitment.min_experience_level' => ['nullable','string','max:100'],
            'recruitment.requires_international_experience' => ['boolean'],
            'recruitment.requires_european_experience' => ['boolean'],
            'recruitment.language_preference' => ['nullable','string','max:100'],
            'recruitment.resale_potential_min' => ['integer','between:0,100'],
            'recruitment.foreign_player_slots_available' => ['integer','between:0,25'],
            'recruitment.homegrown_requirement' => ['integer','between:0,25'],

            'medical.injury_risk_tolerance' => ['integer','between:0,100'],
            'medical.max_injuries_last_2_seasons' => ['integer','between:0,20'],
            'medical.max_days_missed_last_2_seasons' => ['integer','between:0,1000'],
            'medical.accepts_acl_history' => ['boolean'],
            'medical.accepts_recurring_muscle_injuries' => ['boolean'],
            'medical.min_minutes_last_season' => ['integer','min:0'],
            'medical.fitness_priority' => ['required','string','max:50'],
            'medical.medical_review_required' => ['boolean'],

            'squad_needs' => ['nullable','array'],
            'squad_needs.*.position' => ['required_with:squad_needs','string','max:10'],
            'squad_needs.*.need_level' => ['required_with:squad_needs', Rule::enum(NeedLevel::class)],
            'squad_needs.*.required_role' => ['nullable','string','max:100'],
            'squad_needs.*.priority' => ['required_with:squad_needs', Rule::enum(NeedPriority::class)],
            'squad_needs.*.current_players_count' => ['integer','min:0'],
            'squad_needs.*.average_age' => ['integer','between:15,40'],
            'squad_needs.*.quality_level' => ['integer','between:0,100'],
            'squad_needs.*.needs_starter' => ['boolean'],
            'squad_needs.*.needs_backup' => ['boolean'],
            'squad_needs.*.needs_future_prospect' => ['boolean'],
            'squad_needs.*.replace_departing_player' => ['boolean'],
            'squad_needs.*.notes' => ['nullable','string'],

            'team_metrics' => ['nullable','array'],
            'team_metrics.*.season' => ['required_with:team_metrics','string','max:20'],
            'team_metrics.*.goals_scored' => ['integer','min:0'],
            'team_metrics.*.goals_conceded' => ['integer','min:0'],
            'team_metrics.*.xg' => ['numeric','min:0'],
            'team_metrics.*.xga' => ['numeric','min:0'],
            'team_metrics.*.xa' => ['numeric','min:0'],
            'team_metrics.*.shots_per_match' => ['numeric','min:0'],
            'team_metrics.*.shots_on_target_per_match' => ['numeric','min:0'],
            'team_metrics.*.possession_percentage' => ['numeric','between:0,100'],
            'team_metrics.*.pass_accuracy' => ['numeric','between:0,100'],
            'team_metrics.*.progressive_passes' => ['integer','min:0'],
            'team_metrics.*.final_third_entries' => ['integer','min:0'],
            'team_metrics.*.box_entries' => ['integer','min:0'],
            'team_metrics.*.ppda' => ['numeric','min:0'],
            'team_metrics.*.high_turnovers' => ['integer','min:0'],
            'team_metrics.*.successful_counter_attacks' => ['integer','min:0'],
            'team_metrics.*.cross_accuracy' => ['numeric','between:0,100'],
            'team_metrics.*.set_piece_goals' => ['integer','min:0'],

            'staff' => ['nullable','array'],
            'staff.*.name' => ['required_with:staff','string','max:255'],
            'staff.*.role' => ['required_with:staff','string','max:100'],
            'staff.*.email' => ['nullable','email'],
            'staff.*.can_approve_reports' => ['boolean'],
            'staff.*.can_create_players' => ['boolean'],
            'staff.*.can_view_financials' => ['boolean'],
            'staff.*.can_view_medical' => ['boolean'],

            'contract.max_contract_years' => ['integer','between:1,10'],
            'contract.min_contract_years' => ['integer','between:1,10'],
            'contract.release_clause_policy' => ['nullable','string','max:255'],
            'contract.bonus_policy' => ['nullable','string','max:255'],
            'contract.image_rights_policy' => ['nullable','string','max:255'],
            'contract.sell_on_policy' => ['nullable','string','max:255'],
            'contract.buy_back_policy' => ['nullable','string','max:255'],
            'contract.loan_policy' => ['nullable','string','max:255'],
            'contract.agent_fee_policy' => ['nullable','string','max:255'],

            'market.strategy_type' => ['nullable','string','max:100'],
            'market.target_regions' => ['nullable','array'],
            'market.target_countries' => ['nullable','array'],
            'market.target_leagues' => ['nullable','array'],
            'market.market_value_range_min' => ['numeric','min:0'],
            'market.market_value_range_max' => ['numeric','min:0'],
            'market.preferred_deal_type' => ['nullable','string','max:100'],
            'market.undervalued_player_focus' => ['boolean'],
            'market.free_agent_focus' => ['boolean'],
            'market.loan_market_focus' => ['boolean'],
        ];
    }
}
