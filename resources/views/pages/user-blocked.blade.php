<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruiker geblokkeerd') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <i class="fas fa-exclamation-triangle text-4xl text-red-500"></i>
                <p class="text-lg">
                    Je bent geblokkeerd door een admin. Neem contact op met de admin voor meer informatie.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>