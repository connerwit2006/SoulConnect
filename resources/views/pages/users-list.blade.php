<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikerslijst') }}
        </h2>
    </x-slot>

    <div class="py-12 min-h-screen bg-bg1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 bg-bg2">
                    {{ __("Een lijst van alle gebruikers (excl. ingelogde gebruiker)") }}
                </div>

                <div class="space-y-0"> <!-- Set space between items to 0 -->
                    <!-- Container for each user -->
                    @foreach ($users as $user)
                        <div class="flex items-center bg-bg2 p-3 mb-0"> <!-- Removed rounded-lg from div -->
                            <!-- Name -->
                            <div class="flex-1 text-sm text-gray-900">
                                {{ $user->name }}
                            </div>
                            <!-- Email -->
                            <div class="flex-1 text-sm text-gray-900">
                                {{ $user->email }}
                            </div>
                            <!-- Created At -->
                            <div class="flex-1 text-sm text-gray-900">
                                {{ $user->created_at }}
                            </div>

                            <!-- Action Buttons (container) -->
                            <div class="flex items-center space-x-2">
                                <!-- Report Button -->
                                @if ($reportedUsers[$user->id])
                                    <div class="px-4 py-2 bg-yellow-600 text-white rounded-lg">
                                        Gerapporteerd
                                    </div>
                                @else
                                    <a href="{{ route('reportUser', $user->id) }}" class="inline-block px-4 py-2 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-yellow-300">
                                        Rapporteer gebruiker
                                    </a>
                                @endif

                                <!-- Block/Unblock Button -->
                                @if (!$blockedStatuses[$user->id])
                                    <a href="{{ route('blockUser', $user->id) }}" class="inline-block px-4 py-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                        Blokkeer gebruiker
                                    </a>
                                @else
                                    <div class="px-4 py-2 bg-red-600 text-white rounded-lg">
                                        Geblokkeerd
                                    </div>
                                    <a href="{{ route('unblockUser', $user->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                        Deblokkeer gebruiker
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
