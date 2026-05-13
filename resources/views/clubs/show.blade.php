<x-app-layout>
    <x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">{{ $club->name }} Profile Overview</h2></x-slot>
    <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <h3 class="mb-2 font-semibold text-cyan-200">Tactical Summary</h3>
            <p class="text-sm text-slate-300">Formation: {{ $club->tacticalProfile?->primary_formation }}</p>
            <p class="text-sm text-slate-300">Pressing: {{ $club->tacticalProfile?->pressing_style }}</p>
            <p class="text-sm text-slate-300">Possession Target: {{ $club->tacticalProfile?->possession_target }}%</p>
        </div>
        <div class="rounded-xl border border-slate-800 bg-slate-900 p-4">
            <h3 class="mb-2 font-semibold text-cyan-200">Financial Summary</h3>
            <p class="text-sm text-slate-300">Budget: {{ number_format((float) $club->financialRule?->total_transfer_budget, 0) }} {{ $club->currency }}</p>
            <p class="text-sm text-slate-300">Max Fee: {{ number_format((float) $club->financialRule?->max_transfer_fee, 0) }}</p>
            <p class="text-sm text-slate-300">Max Salary: {{ number_format((float) $club->financialRule?->max_salary, 0) }}</p>
        </div>
    </div>

    <div class="mt-4 rounded-xl border border-slate-800 bg-slate-900 p-4">
        <h3 class="mb-2 font-semibold text-cyan-200">Top Priority Squad Needs</h3>
        @forelse($club->squadNeeds->where('priority', 'p1') as $need)
            <p class="text-sm text-slate-300">{{ $need->position }} - {{ $need->required_role }} ({{ $need->need_level }})</p>
        @empty
            <p class="text-sm text-slate-400">No P1 needs configured.</p>
        @endforelse
    </div>
</x-app-layout>
