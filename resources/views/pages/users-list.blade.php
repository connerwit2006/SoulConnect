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

                <div>
                    <!-- Apply bg-bg2 to the table itself and its sections (thead, tbody, tr) -->
                    <table class="min-w-full divide-y divide-gray-200 bg-bg2">
                        <thead class="bg-bg2">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Naam
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aangemaakt op
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actie
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-bg2 divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="bg-bg2">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->created_at }}</div>
                                    </td>
                                    @if ($reportedUsers[$user->id])
                                        <td class="px-6 py-4 whitespace-nowrap bg-yellow-600 text-white rounded-lg">
                                            Gerapporteerd
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('reportUser', $user->id) }}" class="inline-block px-6 py-2 bg-yellow-500 text-white rounded-lg shadow-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-300">
                                                Rapporteer gebruiker
                                            </a>
                                        </td>
                                    @endif
                                  
                                    @if (!$blockedStatuses[$user->id])
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('blockUser', $user->id) }}" class="inline-block px-6 py-2 bg-red-500 text-white rounded-lg shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                                                Blokkeer gebruiker
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap bg-red-600 text-white rounded-lg">
                                            Geblokkeerd
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('unblockUser', $user->id) }}" class="inline-block px-6 py-2 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                                                Deblokkeer gebruiker
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
