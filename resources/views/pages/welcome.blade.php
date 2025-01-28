<x-app-layout>
    <div class="container mx-auto px-4 pt-12 max-w-6xl">
        <!-- Title -->
        <h1 class="text-4xl font-bold text-center mb-12 text-gray-700">Vind je perfecte match vandaag!</h1>

        <!-- Homepage Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 pb-20">
            <!-- Login/SingUp Card -->
            <div class="flex justify-center">
                <div class="flex flex-col w-full max-w-md rounded-xl border border-gray-200 bg-white shadow-lg">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="image/HomePage2.jpg" loading="lazy" alt="Person on Phone" class="w-full h-full object-contain rounded-t-xl" />
                        <p class="sr-only">
                            Afbeelding ontworpen door <a href="https://www.freepik.com/wayhomestudio" target="_blank" rel="noopener noreferrer">wayhomestudio</a> op <a href="https://www.freepik.com" target="_blank" rel="noopener noreferrer">Freepik</a>.
                        </p>
                    </div>

                    <div class="p-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">Login / Registreer</h2>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Maak een gratis account aan en ontdek jouw perfecte match. Vul je profiel in en ontvang gepersonaliseerde matches op basis van jouw voorkeuren. Begin vandaag nog en laat het algoritme voor jou werken. Vind iemand die perfect bij jou past en maak jouw datingervaring onvergetelijk.                        </p>
                        <div class="mt-4 flex justify-center gap-3">
                            @auth
                                <div class="relative">
                                    <!-- User Name with Dropdown Arrow -->
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 bg-accent px-5 py-2 rounded-md text-white">
                                        Dashboard
                                    </a>
                                </div>
                            @else
                                <div class="flex gap-4">
                                    <a href="/login" class="bg-accent text-white font-medium py-2 px-6 rounded hover:scale-105 transition-transform">Inloggen</a>
                                    <a href="/register" class="bg-accent text-white font-medium py-2 px-6 rounded hover:scale-105 transition-transform">Registreren</a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Advantage Card -->
            <div class="flex justify-center">
                <div class="flex flex-col w-full max-w-md rounded-xl border border-gray-200 bg-white shadow-lg">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="image/Detail4.jpg" loading="lazy" alt="Person Pointing" class="w-full h-full object-contain rounded-t-xl" />
                        <p class="sr-only">
                            Afbeelding ontworpen door <a href="https://www.freepik.com/wayhomestudio" target="_blank" rel="noopener noreferrer">wayhomestudio</a> op <a href="https://www.freepik.com" target="_blank" rel="noopener noreferrer">Freepik</a>.
                        </p>
                    </div>

                    <div class="p-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">Dagelijkse Voordelen</h2>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Ontvang dagelijks een lijst met jouw top 5 matches. Ons slimme algoritme maakt daten makkelijker en leuker!
                        </p>
                        <ul class="mt-4 list-disc pl-5 text-gray-700 text-sm">
                            <li>Gepersonaliseerde matches op maat.</li>
                            <li>Toegang tot een veilige chatomgeving.</li>
                            <li><a href="#" class="text-blue-500 hover:underline">Hoe werkt het?</a></li>
                            <li><a href="#" class="text-blue-500 hover:underline">Veelgestelde vragen</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Safe Dating Card -->
            <div class="flex justify-center">
                <div class="flex flex-col w-full max-w-md rounded-xl border border-gray-200 bg-white shadow-lg">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="image/HomePage1.jpg" loading="lazy" alt="Person Smiling" class="w-full h-full object-contain rounded-t-xl" />
                        <p class="sr-only">
                            Afbeelding ontworpen door <a href="https://www.freepik.com/wayhomestudio" target="_blank" rel="noopener noreferrer">wayhomestudio</a> op <a href="https://www.freepik.com" target="_blank" rel="noopener noreferrer">Freepik</a>.
                        </p>
                    </div>

                    <div class="p-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">Veilig Daten</h2>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Veiligheid staat bij ons voorop. Alle profielen worden zorgvuldig gecontroleerd en wij bieden een veilige omgeving voor jou en je matches.
                        </p>
                        <ul class="mt-4 list-disc pl-5 text-gray-700 text-sm">
                            <li>Profielverificatie voor extra zekerheid.</li>
                            <li>100% veilige chat met geavanceerde beveiliging.</li>
                            <li>Wij regelen alles voor jou!</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Always And Everywhere Card -->
            <div class="flex justify-center">
                <div class="flex flex-col w-full max-w-md rounded-xl border border-gray-200 bg-white shadow-lg">
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="image/HomePage3.jpg" loading="lazy" alt="Person Relaxing" class="w-full h-full object-contain rounded-t-xl" />
                        <p class="sr-only">
                            Afbeelding ontworpen door <a href="https://www.freepik.com/wayhomestudio" target="_blank" rel="noopener noreferrer">wayhomestudio</a> op <a href="https://www.freepik.com" target="_blank" rel="noopener noreferrer">Freepik</a>.
                        </p>
                    </div>

                    <div class="p-6 flex-1">
                        <h2 class="text-2xl font-bold text-gray-700 mb-4">Altijd en Overal</h2>
                        <p class="text-gray-700 text-base leading-relaxed">
                            Gebruik ons platform op elk apparaat. Of je nu onderweg bent of thuis op de bank zit, blijf altijd verbonden met je matches.
                        </p>
                        <ul class="mt-4 list-disc pl-5 text-gray-700 text-sm">
                            <li>Geschikt voor mobiel, tablet en desktop.</li>
                            <li>Snel toegang tot je profiel en berichten.</li>
                            <li>Blijf op de hoogte met meldingen.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
