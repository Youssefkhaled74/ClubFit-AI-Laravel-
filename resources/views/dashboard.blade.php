<x-app-layout>
    <x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Performance Dashboard</h2></x-slot>
    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Total Players</p><p class="text-3xl font-bold">{{ $totalPlayers }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Reports</p><p class="text-3xl font-bold">{{ $totalReports }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Average Fit</p><p class="text-3xl font-bold text-emerald-300">{{ $averageFitScore }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><a href="{{ route('reports.create') }}" class="rounded bg-cyan-500 px-4 py-2 font-semibold text-slate-950">New Analysis</a></div>
    </div>
    <div class="mt-6 rounded-xl border border-slate-800 bg-slate-900 p-4">
        <h3 class="mb-3 text-lg font-semibold">Recommended Players</h3>
        <ul class="space-y-2">@forelse($recommendedPlayers as $item)<li>{{ $item->player?->name }} <span class="text-emerald-300">({{ $item->final_fit_score }})</span></li>@empty<li class="text-slate-400">No high-fit players yet.</li>@endforelse</ul>
    </div>
</x-app-layout>
