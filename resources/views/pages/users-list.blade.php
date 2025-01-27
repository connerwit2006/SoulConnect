<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikerslijst') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Een lijst van alle gebruikers (excl. ingelogde gebruiker)") }}
                </div>

                <div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
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
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr>
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
                                        <td class="px-6 py-4 whitespace-nowrap bg-yellow-600 color-white">
                                            Gerapporteerd
                                        </td>
                                    @else
                                        <td>
                                            <a href="{{ route('reportUser', $user->id) }}" class="p-4 bg-yellow-400 hover:bg-yellow-600">
                                                Rapporteer gebruiker {{ $user->name }}
                                            </a>
                                        </td>
                                    @endif
                                    
                                    @if (!$blockedStatuses[$user->id])
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('blockUser', $user->id) }}" class="p-4 bg-red-400 hover:bg-red-600">
                                                Blokkeer gebruiker {{ $user->name }}
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-6 py-4 whitespace-nowrap bg-red-600 color-white">
                                            Geblokkeerd
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('unblockUser', $user->id) }}" class="p-4 bg-green-400 hover:bg-green-600">
                                                Deblokkeer gebruiker {{ $user->name }}
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