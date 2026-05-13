<x-app-layout>
    <x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Edit Club Setup: {{ $club->name }}</h2></x-slot>
    @include('clubs.partials.form', ['action' => route('clubs.update', $club), 'method' => 'PUT'])
</x-app-layout>
