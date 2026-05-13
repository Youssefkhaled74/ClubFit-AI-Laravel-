<x-app-layout>
    <x-slot name="header"><h2 class="text-2xl font-bold text-cyan-300">Club Profile Setup</h2></x-slot>
    @include('clubs.partials.form', ['action' => route('clubs.store'), 'method' => 'POST'])
</x-app-layout>
