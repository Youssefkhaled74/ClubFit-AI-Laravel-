<x-app-layout><x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Club Profile Form</h2></x-slot>
<form method="POST" action="{{ isset($clubProfile) ? route('club-profiles.update',$clubProfile) : route('club-profiles.store') }}" class="space-y-4 rounded border border-slate-800 bg-slate-900 p-4">@csrf @if(isset($clubProfile)) @method('PUT') @endif
<input name="club_name" placeholder="Club name" value="{{ old('club_name',$clubProfile->club_name ?? '') }}" class="w-full rounded bg-slate-800" />
<input name="formation" placeholder="Formation" value="{{ old('formation',$clubProfile->formation ?? '') }}" class="w-full rounded bg-slate-800" />
<input name="playing_style" placeholder="Playing style" value="{{ old('playing_style',$clubProfile->playing_style ?? '') }}" class="w-full rounded bg-slate-800" />
<input name="budget" type="number" step="0.01" placeholder="Budget" value="{{ old('budget',$clubProfile->budget ?? '') }}" class="w-full rounded bg-slate-800" />
<input name="salary_limit" type="number" step="0.01" placeholder="Salary Limit" value="{{ old('salary_limit',$clubProfile->salary_limit ?? '') }}" class="w-full rounded bg-slate-800" />
<input name="needed_positions[]" placeholder="Needed position 1" class="w-full rounded bg-slate-800" />
<input name="needed_positions[]" placeholder="Needed position 2" class="w-full rounded bg-slate-800" />
<div class="grid grid-cols-3 gap-2"><input name="age_min" type="number" placeholder="Age Min" value="{{ old('age_min',$clubProfile->age_min ?? '') }}" class="rounded bg-slate-800" /><input name="age_max" type="number" placeholder="Age Max" value="{{ old('age_max',$clubProfile->age_max ?? '') }}" class="rounded bg-slate-800" /><input name="injury_tolerance" type="number" placeholder="Injury Tolerance" value="{{ old('injury_tolerance',$clubProfile->injury_tolerance ?? '') }}" class="rounded bg-slate-800" /></div>
<button class="rounded bg-cyan-500 px-4 py-2 text-slate-950">Save</button></form></x-app-layout>
