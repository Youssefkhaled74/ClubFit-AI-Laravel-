@php
    $identity = $club->identity ?? null;
    $tactical = $club->tacticalProfile ?? null;
    $financial = $club->financialRule ?? null;
    $recruitment = $club->recruitmentPolicy ?? null;
    $medical = $club->medicalPolicy ?? null;
    $contract = $club->contractRule ?? null;
    $market = $club->marketStrategy ?? null;
    $squadNeeds = $club->squadNeeds->count() ? $club->squadNeeds : collect([null]);
    $teamMetrics = $club->teamMetrics->count() ? $club->teamMetrics : collect([null]);
    $staffRows = $club->staff->count() ? $club->staff : collect([null]);
@endphp

<form action="{{ $action }}" method="POST" class="space-y-4" x-data="{ tab: 1 }">
    @csrf
    @if($method !== 'POST') @method($method) @endif

    <div class="flex flex-wrap gap-2">
        @foreach([1=>'Basic Information',2=>'Club Identity',3=>'Tactical Style',4=>'Squad Needs',5=>'Financial Rules',6=>'Recruitment Policy',7=>'Medical Policy',8=>'Team Performance',9=>'Staff & Workflow',10=>'Academy Strategy',11=>'Contract Rules',12=>'Market Strategy'] as $i => $label)
            <button type="button" @click="tab={{ $i }}" class="rounded border border-slate-700 px-3 py-1 text-xs" :class="tab === {{ $i }} ? 'bg-cyan-500 text-slate-950' : 'bg-slate-900 text-slate-300'">{{ $label }}</button>
        @endforeach
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===1">
        <div class="grid gap-3 md:grid-cols-3">
            <input name="name" value="{{ old('name', $club->name) }}" placeholder="Club Name" class="rounded bg-slate-800" />
            <input name="country" value="{{ old('country', $club->country) }}" placeholder="Country" class="rounded bg-slate-800" />
            <input name="league" value="{{ old('league', $club->league) }}" placeholder="League" class="rounded bg-slate-800" />
            <input name="season" value="{{ old('season', $club->season) }}" placeholder="Season" class="rounded bg-slate-800" />
            <input name="logo" value="{{ old('logo', $club->logo) }}" placeholder="Logo URL" class="rounded bg-slate-800" />
            <input name="currency" value="{{ old('currency', $club->currency ?? 'EUR') }}" placeholder="Currency" class="rounded bg-slate-800" />
            <input name="primary_color" value="{{ old('primary_color', $club->primary_color) }}" placeholder="Primary Color" class="rounded bg-slate-800" />
            <input name="secondary_color" value="{{ old('secondary_color', $club->secondary_color) }}" placeholder="Secondary Color" class="rounded bg-slate-800" />
            <input name="club_level" value="{{ old('club_level', $club->club_level) }}" placeholder="Club Level" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===2">
        <textarea name="identity[football_philosophy]" class="w-full rounded bg-slate-800" placeholder="Football Philosophy">{{ old('identity.football_philosophy', $identity?->football_philosophy) }}</textarea>
        <div class="mt-3 grid gap-3 md:grid-cols-3">
            <input name="identity[business_model]" value="{{ old('identity.business_model', $identity?->business_model) }}" placeholder="Business Model" class="rounded bg-slate-800" />
            <select name="identity[risk_appetite]" class="rounded bg-slate-800">@foreach($riskAppetites as $risk)<option value="{{ $risk->value }}" @selected(old('identity.risk_appetite',$identity?->risk_appetite ?? 'balanced')===$risk->value)>{{ ucfirst($risk->value) }}</option>@endforeach</select>
            <input name="identity[star_player_policy]" value="{{ old('identity.star_player_policy', $identity?->star_player_policy) }}" placeholder="Star Player Policy" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===3">
        <div class="grid gap-3 md:grid-cols-3">
            <select name="tactical[primary_formation]" class="rounded bg-slate-800">@foreach($formations as $formation)<option value="{{ $formation }}" @selected(old('tactical.primary_formation',$tactical?->primary_formation)===$formation)>{{ $formation }}</option>@endforeach</select>
            <select name="tactical[secondary_formation]" class="rounded bg-slate-800">@foreach($formations as $formation)<option value="{{ $formation }}" @selected(old('tactical.secondary_formation',$tactical?->secondary_formation)===$formation)>{{ $formation }}</option>@endforeach</select>
            <select name="tactical[pressing_style]" class="rounded bg-slate-800">@foreach($pressingStyles as $style)<option value="{{ $style->value }}" @selected(old('tactical.pressing_style',$tactical?->pressing_style ?? 'mid_block')===$style->value)>{{ ucfirst(str_replace('_',' ',$style->value)) }}</option>@endforeach</select>
            <input name="tactical[attacking_shape]" value="{{ old('tactical.attacking_shape', $tactical?->attacking_shape) }}" placeholder="Attacking Shape" class="rounded bg-slate-800" />
            <input name="tactical[defensive_shape]" value="{{ old('tactical.defensive_shape', $tactical?->defensive_shape) }}" placeholder="Defensive Shape" class="rounded bg-slate-800" />
            <input name="tactical[build_up_style]" value="{{ old('tactical.build_up_style', $tactical?->build_up_style) }}" placeholder="Build-up Style" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===4">
        @foreach($squadNeeds as $i => $need)
            <div class="mb-3 grid gap-2 md:grid-cols-4">
                <input name="squad_needs[{{ $i }}][position]" value="{{ old("squad_needs.$i.position", $need?->position) }}" placeholder="Position" class="rounded bg-slate-800" />
                <select name="squad_needs[{{ $i }}][need_level]" class="rounded bg-slate-800">@foreach($needLevels as $level)<option value="{{ $level->value }}" @selected(old("squad_needs.$i.need_level", $need?->need_level ?? 'medium')===$level->value)>{{ ucfirst($level->value) }}</option>@endforeach</select>
                <select name="squad_needs[{{ $i }}][priority]" class="rounded bg-slate-800">@foreach($needPriorities as $p)<option value="{{ $p->value }}" @selected(old("squad_needs.$i.priority", $need?->priority ?? 'p2')===$p->value)>{{ strtoupper($p->value) }}</option>@endforeach</select>
                <input name="squad_needs[{{ $i }}][required_role]" value="{{ old("squad_needs.$i.required_role", $need?->required_role) }}" placeholder="Required Role" class="rounded bg-slate-800" />
            </div>
        @endforeach
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===5">
        <div class="grid gap-3 md:grid-cols-3">
            <input type="number" step="0.01" name="financial[total_transfer_budget]" value="{{ old('financial.total_transfer_budget', $financial?->total_transfer_budget) }}" placeholder="Total Transfer Budget" class="rounded bg-slate-800" />
            <input type="number" step="0.01" name="financial[max_transfer_fee]" value="{{ old('financial.max_transfer_fee', $financial?->max_transfer_fee) }}" placeholder="Max Transfer Fee" class="rounded bg-slate-800" />
            <input type="number" step="0.01" name="financial[max_salary]" value="{{ old('financial.max_salary', $financial?->max_salary) }}" placeholder="Max Salary" class="rounded bg-slate-800" />
            <select name="financial[financial_risk_tolerance]" class="rounded bg-slate-800">@foreach($riskAppetites as $risk)<option value="{{ $risk->value }}" @selected(old('financial.financial_risk_tolerance',$financial?->financial_risk_tolerance ?? 'balanced')===$risk->value)>{{ ucfirst($risk->value) }}</option>@endforeach</select>
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===6">
        <div class="grid gap-3 md:grid-cols-3">
            <input type="number" name="recruitment[min_age]" value="{{ old('recruitment.min_age', $recruitment?->min_age) }}" placeholder="Min Age" class="rounded bg-slate-800" />
            <input type="number" name="recruitment[max_age]" value="{{ old('recruitment.max_age', $recruitment?->max_age) }}" placeholder="Max Age" class="rounded bg-slate-800" />
            <input name="recruitment[min_experience_level]" value="{{ old('recruitment.min_experience_level', $recruitment?->min_experience_level) }}" placeholder="Min Experience Level" class="rounded bg-slate-800" />
            <input name="recruitment[preferred_nationalities][]" value="{{ old('recruitment.preferred_nationalities.0', $recruitment?->preferred_nationalities[0] ?? '') }}" placeholder="Preferred Nationality" class="rounded bg-slate-800" />
            <input name="recruitment[preferred_leagues][]" value="{{ old('recruitment.preferred_leagues.0', $recruitment?->preferred_leagues[0] ?? '') }}" placeholder="Preferred League" class="rounded bg-slate-800" />
            <input name="recruitment[language_preference]" value="{{ old('recruitment.language_preference', $recruitment?->language_preference) }}" placeholder="Language Preference" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===7">
        <div class="grid gap-3 md:grid-cols-3">
            <input type="number" name="medical[injury_risk_tolerance]" value="{{ old('medical.injury_risk_tolerance', $medical?->injury_risk_tolerance) }}" placeholder="Injury Risk Tolerance" class="rounded bg-slate-800" />
            <input type="number" name="medical[max_injuries_last_2_seasons]" value="{{ old('medical.max_injuries_last_2_seasons', $medical?->max_injuries_last_2_seasons) }}" placeholder="Max Injuries 2 Seasons" class="rounded bg-slate-800" />
            <input type="number" name="medical[max_days_missed_last_2_seasons]" value="{{ old('medical.max_days_missed_last_2_seasons', $medical?->max_days_missed_last_2_seasons) }}" placeholder="Max Days Missed" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===8">
        @foreach($teamMetrics as $i => $metric)
            <div class="grid gap-2 md:grid-cols-4">
                <input name="team_metrics[{{ $i }}][season]" value="{{ old("team_metrics.$i.season", $metric?->season) }}" placeholder="Season" class="rounded bg-slate-800" />
                <input type="number" name="team_metrics[{{ $i }}][goals_scored]" value="{{ old("team_metrics.$i.goals_scored", $metric?->goals_scored) }}" placeholder="Goals Scored" class="rounded bg-slate-800" />
                <input type="number" name="team_metrics[{{ $i }}][goals_conceded]" value="{{ old("team_metrics.$i.goals_conceded", $metric?->goals_conceded) }}" placeholder="Goals Conceded" class="rounded bg-slate-800" />
                <input type="number" step="0.01" name="team_metrics[{{ $i }}][xg]" value="{{ old("team_metrics.$i.xg", $metric?->xg) }}" placeholder="xG" class="rounded bg-slate-800" />
            </div>
        @endforeach
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===9">
        @foreach($staffRows as $i => $staff)
            <div class="grid gap-2 md:grid-cols-3">
                <input name="staff[{{ $i }}][name]" value="{{ old("staff.$i.name", $staff?->name) }}" placeholder="Staff Name" class="rounded bg-slate-800" />
                <input name="staff[{{ $i }}][role]" value="{{ old("staff.$i.role", $staff?->role) }}" placeholder="Role" class="rounded bg-slate-800" />
                <input name="staff[{{ $i }}][email]" value="{{ old("staff.$i.email", $staff?->email) }}" placeholder="Email" class="rounded bg-slate-800" />
            </div>
        @endforeach
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===10">
        <p class="text-sm text-slate-400">Academy Strategy is represented through identity and recruitment policy settings such as youth preference, resale focus, and age profile.</p>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===11">
        <div class="grid gap-2 md:grid-cols-3">
            <input type="number" name="contract[min_contract_years]" value="{{ old('contract.min_contract_years', $contract?->min_contract_years) }}" placeholder="Min Contract Years" class="rounded bg-slate-800" />
            <input type="number" name="contract[max_contract_years]" value="{{ old('contract.max_contract_years', $contract?->max_contract_years) }}" placeholder="Max Contract Years" class="rounded bg-slate-800" />
            <input name="contract[release_clause_policy]" value="{{ old('contract.release_clause_policy', $contract?->release_clause_policy) }}" placeholder="Release Clause Policy" class="rounded bg-slate-800" />
        </div>
    </div>

    <div class="rounded-xl border border-slate-800 bg-slate-900 p-4" x-show="tab===12">
        <div class="grid gap-2 md:grid-cols-3">
            <input name="market[strategy_type]" value="{{ old('market.strategy_type', $market?->strategy_type) }}" placeholder="Strategy Type" class="rounded bg-slate-800" />
            <input name="market[target_regions][]" value="{{ old('market.target_regions.0', $market?->target_regions[0] ?? '') }}" placeholder="Target Region" class="rounded bg-slate-800" />
            <input name="market[target_leagues][]" value="{{ old('market.target_leagues.0', $market?->target_leagues[0] ?? '') }}" placeholder="Target League" class="rounded bg-slate-800" />
        </div>
    </div>

    <button class="rounded bg-cyan-500 px-6 py-2 font-semibold text-slate-950">Save Club Setup</button>
</form>

@if ($errors->any())
    <div class="mt-4 rounded bg-rose-900/40 p-3 text-rose-300">
        <p class="font-semibold">Please fix validation errors:</p>
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
