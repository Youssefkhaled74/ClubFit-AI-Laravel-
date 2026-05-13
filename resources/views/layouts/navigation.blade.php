<nav class="border-b border-slate-800 bg-slate-900/80 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4">
        <div class="flex items-center gap-6">
            <a class="text-xl font-bold text-cyan-400" href="{{ route('dashboard') }}">ClubFit AI</a>
            <a class="text-slate-300 hover:text-cyan-400" href="{{ route('club-profiles.index') }}">Clubs</a>
            <a class="text-slate-300 hover:text-cyan-400" href="{{ route('players.index') }}">Players</a>
            <a class="text-slate-300 hover:text-cyan-400" href="{{ route('reports.index') }}">Reports</a>
        </div>
        <div class="flex items-center gap-4 text-sm">
            <span class="rounded bg-slate-800 px-3 py-1 text-cyan-300">{{ auth()->user()->name }} · {{ auth()->user()->role }}</span>
            <form method="POST" action="{{ route('logout') }}">@csrf <button class="text-rose-300 hover:text-rose-200">Logout</button></form>
        </div>
    </div>
</nav>
