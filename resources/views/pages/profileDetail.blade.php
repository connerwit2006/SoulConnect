<x-app-layout>
    <!-- Person Details -->
    <x-detail-person
        :person="[
            'id' => 6,
            'name' => 'Thomas Verbeek',
            'age' => 28,
            'location' => 'Deventer',
            'gender' => 'Man',
            'description' => 'Ik ben een 28-jarige avonturier die het leven met een gezonde dosis humor, nieuwsgierigheid en enthousiasme tegemoet gaat. Elke dag zie ik als een kans om nieuwe ervaringen op te doen en herinneringen te creëren. Overdag werk ik met veel passie als freelance fotograaf, waar ik verhalen vertel door middel van beelden en momenten vastleg die mensen voor altijd willen koesteren.
            Wanneer het weekend begint, kun je me vaak vinden op een uitdagende wandelroute in de natuur, waar ik geniet van de rust en de schoonheid van de omgeving. Maar ik ben net zo graag op een gezellig terras met goede vrienden, waar we urenlang kunnen lachen en praten over alles wat het leven te bieden heeft. En als ik niet buiten ben, dan verdwijn ik het liefst in de pagina’s van een meeslepend boek, waar ik me laat meevoeren naar nieuwe werelden en perspectieven.
            Ik geloof in het vinden van balans tussen hard werken en genieten van de kleine dingen in het leven. Of ik nu achter mijn camera sta, een nieuwe berg beklim, of gewoonweg geniet van een heerlijke kop koffie op een zonnige ochtend, ik leef elke dag met volle overgave en hoop anderen te inspireren hetzelfde te doen.',
            'img' => 'https://images.unsplash.com/photo-1463453091185-61582044d556?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
        ]"
        :slides="[
            ['image' => asset('image/HappyMen.jpg')],
            ['image' => asset('image/HappyMen2.jpg')],
            ['image' => asset('image/PersonOnPhone.jpg')]
        ]"
    />

    <!-- Potential Matches Showcase -->
    <x-peopleShowcase
        title="Potentiële Matches!"
        :people="[
            ['id' => 6, 'name' => 'David Willems', 'img' => 'https://randomuser.me/api/portraits/men/6.jpg'],
            ['id' => 7, 'name' => 'Nina Kuipers', 'img' => 'https://randomuser.me/api/portraits/women/7.jpg'],
            ['id' => 8, 'name' => 'Jan de Boer', 'img' => 'https://randomuser.me/api/portraits/men/8.jpg'],
            ['id' => 9, 'name' => 'Emma Smits', 'img' => 'https://randomuser.me/api/portraits/women/9.jpg'],
            ['id' => 10, 'name' => 'Lucas Visser', 'img' => 'https://randomuser.me/api/portraits/men/10.jpg']
        ]"
    />
</x-app-layout>
