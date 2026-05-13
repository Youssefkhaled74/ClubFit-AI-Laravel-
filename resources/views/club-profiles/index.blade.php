<x-app-layout>
<x-slot name="header"><div class="flex justify-between"><h2 class="text-2xl font-bold text-cyan-300">Club Profiles</h2><a href="{{ route('club-profiles.create') }}" class="rounded bg-cyan-500 px-4 py-2 text-slate-950">Add Club</a></div></x-slot>
@if(session('success'))<p class="mb-4 rounded bg-emerald-900/40 p-3 text-emerald-300">{{ session('success') }}</p>@endif
<div class="space-y-3">@foreach($profiles as $profile)<div class="rounded border border-slate-800 bg-slate-900 p-4 flex justify-between"><div><p class="font-semibold">{{ $profile->club_name }}</p><p class="text-slate-400">{{ $profile->formation }} · {{ $profile->playing_style }}</p></div><div class="space-x-2"><a href="{{ route('club-profiles.show',$profile) }}">View</a><a href="{{ route('club-profiles.edit',$profile) }}">Edit</a></div></div>@endforeach</div>{{ $profiles->links() }}
</x-app-layout>
