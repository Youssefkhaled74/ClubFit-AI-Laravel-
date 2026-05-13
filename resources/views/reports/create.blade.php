<x-app-layout><x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">New Analysis</h2></x-slot>
<form method="POST" action="{{ route('reports.store') }}" class="space-y-3 rounded border border-slate-800 bg-slate-900 p-4">@csrf
<select name="club_profile_id" class="w-full rounded bg-slate-800">@foreach($clubs as $club)<option value="{{ $club->id }}">{{ $club->club_name }}</option>@endforeach</select>
<select name="player_id" class="w-full rounded bg-slate-800">@foreach($players as $player)<option value="{{ $player->id }}">{{ $player->name }} ({{ $player->position }})</option>@endforeach</select>
<button class="rounded bg-cyan-500 px-4 py-2 text-slate-950">Generate Fit Report</button></form></x-app-layout>
