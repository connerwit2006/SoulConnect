<x-app-layout>
    <div class="container mx-auto px-4 mt-10" x-data="{ loggedIn: {{ Auth::check() ? 'true' : 'false' }} }">
        <!-- Titel -->
        <h1 class="text-3xl font-bold text-center mb-8">Vind je perfecte match vandaag!</h1>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="border rounded-lg p-6 text-center shadow-md">
                <template x-if="!loggedIn">
                    <p class="text-xl font-semibold mb-4">Maak nu je gratis account aan!</p>

                    <div class="flex gap-4 w-full">
                        <a class="w-full bg-accent text-white font-medium py-2 px-4 rounded mb-4 hover:scale-105 transition-transform">Inloggen</a>
                        <a class="w-full bg-accent text-white font-medium py-2 px-4 rounded hover:scale-105 transition-transform">Registreren</a>
                    </div>
                </template>

                <template x-if="loggedIn">
                    <div >
                        <a class="w-full bg-accent text-white font-medium py-2 px-4 rounded hover:scale-105 transition-transform" href="/profile">Mijn Profiel</a>
                    </div>
                </template>
            </div>

            <!-- Right Column -->
            <div class="border rounded-lg p-6 text-center shadow-md">
                <ul class="space-y-4">
                    <li class="text-lg font-medium">Dagelijkse top 5 matches.</li>
                    <li class="text-lg font-medium">Chat met je matches na verificatie.</li>
                    <li><a href="#" class="text-blue-500 hover:underline">Hoe werkt het?</a></li>
                    <li><a href="#" class="text-blue-500 hover:underline">FAQ</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
