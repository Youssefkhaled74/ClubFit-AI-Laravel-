<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-cyan-300">Clubs</h2>
            <a href="{{ route('clubs.create') }}" class="rounded bg-cyan-500 px-4 py-2 font-semibold text-slate-950">New Club Setup</a>
        </div>
    </x-slot>

    @if(session('success'))<p class="mb-4 rounded bg-emerald-900/40 p-3 text-emerald-300">{{ session('success') }}</p>@endif

    <div class="space-y-3">
        @foreach($clubs as $club)
            <div class="flex items-center justify-between rounded-xl border border-slate-800 bg-slate-900 p-4">
                <div>
                    <p class="font-semibold text-slate-100">{{ $club->name }}</p>
                    <p class="text-sm text-slate-400">{{ $club->country }} · {{ $club->league }} · {{ $club->season }}</p>
                </div>
                <div class="space-x-3 text-sm">
                    <a class="text-cyan-300" href="{{ route('clubs.show', $club) }}">View</a>
                    <a class="text-amber-300" href="{{ route('clubs.edit', $club) }}">Edit</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">{{ $clubs->links() }}</div>
</x-app-layout>
