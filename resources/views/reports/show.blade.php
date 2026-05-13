<x-app-layout><x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Fit Report</h2></x-slot>
<div class="rounded border border-slate-800 bg-slate-900 p-4 space-y-2"><p><strong>Club:</strong> {{ $report->clubProfile->club_name }}</p><p><strong>Player:</strong> {{ $report->player->name }}</p>
<p>Technical Fit: {{ $report->technical_fit }}</p><p>Tactical Fit: {{ $report->tactical_fit }}</p><p>Financial Fit: {{ $report->financial_fit }}</p><p>Medical Risk: {{ $report->medical_risk }}</p><p>Squad Need: {{ $report->squad_need }}</p><p class="text-xl text-emerald-300">Final Score: {{ $report->final_fit_score }}</p><p class="rounded bg-slate-800 p-3 text-cyan-100">{{ $report->recommendation }}</p></div>
</x-app-layout>
