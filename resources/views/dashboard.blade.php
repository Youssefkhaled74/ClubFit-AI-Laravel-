<x-app-layout>
    <x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">ClubFit AI Dashboard</h2></x-slot>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Total Clubs</p><p class="text-3xl font-bold">{{ $totalClubs }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Total Squad Needs</p><p class="text-3xl font-bold">{{ $totalSquadNeeds }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Total Reports</p><p class="text-3xl font-bold">{{ $totalReports }}</p></div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4"><p class="text-slate-400">Avg Fit Score</p><p class="text-3xl font-bold text-emerald-300">{{ $averageFitScore ?: '0.00' }}</p></div>
    </div>

    <div class="mt-6 grid gap-4 md:grid-cols-3">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <h3 class="mb-3 font-semibold text-cyan-200">Club Tactical Summary</h3>
            @forelse($clubTacticalSummary as $club)
                <p class="text-sm text-slate-300">{{ $club->name }}: {{ $club->tacticalProfile?->primary_formation }} / {{ $club->tacticalProfile?->pressing_style }}</p>
            @empty
                <p class="text-sm text-slate-400">No tactical profiles yet.</p>
            @endforelse
        </div>

        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <h3 class="mb-3 font-semibold text-cyan-200">Financial Limits Summary</h3>
            @forelse($financialLimitsSummary as $club)
                <p class="text-sm text-slate-300">{{ $club->name }}: Max Fee {{ number_format((float) $club->financialRule?->max_transfer_fee, 0) }} {{ $club->currency }}</p>
            @empty
                <p class="text-sm text-slate-400">No financial rules yet.</p>
            @endforelse
        </div>

        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <h3 class="mb-3 font-semibold text-cyan-200">Top Priority Positions</h3>
            @forelse($topPriorityPositions as $position)
                <p class="text-sm text-slate-300">{{ $position->position }} ({{ $position->total }})</p>
            @empty
                <p class="text-sm text-slate-400">No P1 positions recorded.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
