<x-app-layout><x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Player Form</h2></x-slot>
<form method="POST" action="{{ isset($player) ? route('players.update',$player) : route('players.store') }}" class="space-y-2 rounded border border-slate-800 bg-slate-900 p-4">@csrf @if(isset($player)) @method('PUT') @endif
@foreach(['name','position'] as $f)<input name="{{ $f }}" placeholder="{{ ucfirst($f) }}" value="{{ old($f,$player->$f ?? '') }}" class="w-full rounded bg-slate-800" />@endforeach
<div class="grid grid-cols-3 gap-2">@foreach(['age','market_value','salary','contract_years','goals','assists','passing_accuracy','pressing_score','minutes_played','injury_history'] as $n)<input type="number" step="0.01" name="{{ $n }}" placeholder="{{ $n }}" value="{{ old($n,$player->$n ?? '') }}" class="rounded bg-slate-800" />@endforeach</div>
<button class="rounded bg-cyan-500 px-4 py-2 text-slate-950">Save</button></form></x-app-layout>
