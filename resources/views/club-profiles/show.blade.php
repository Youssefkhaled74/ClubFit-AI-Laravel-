<x-app-layout><x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">{{ $clubProfile->club_name }}</h2></x-slot>
<div class="rounded border border-slate-800 bg-slate-900 p-4"><p>Formation: {{ $clubProfile->formation }}</p><p>Style: {{ $clubProfile->playing_style }}</p><p>Needed: {{ implode(', ', $clubProfile->needed_positions ?? []) }}</p></div>
</x-app-layout>
