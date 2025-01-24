<x-app-layout>
    <!-- Person Details -->
    <x-detail-person :person="['id' => 6, 'name' => 'Thomas Verbeek', 'age' => 28, 'location' => 'Deventer', 'gender' => 'Man', 'description' => '                            Ik ben een 28-jarige avonturier die het leven met een gezonde dosis humor en nieuwsgierigheid tegemoet gaat. Overdag werk ik als freelance fotograaf, maar zodra het weekend begint, vind je me op een nieuwe wandelroute, een gezellig terras of verdwaald in een goed boek.
    ', 'img' => 'https://images.unsplash.com/photo-1463453091185-61582044d556?q=80&w=3540&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D']"/>

    <!-- Potential Matches Showcase -->
    <x-peopleShowcase
        title="Potentiële Matches!"
        :people="[
                ['id' => 6, 'name' => 'David Willems', 'img' => 'https://randomuser.me/api/portraits/men/6.jpg'],
                ['id' => 7, 'name' => 'Nina Kuipers', 'img' => 'https://randomuser.me/api/portraits/women/7.jpg'],
                ['id' => 8, 'name' => 'Jan de Boer', 'img' => 'https://randomuser.me/api/portraits/men/8.jpg'],
                ['id' => 9, 'name' => 'Emma Smits', 'img' => 'https://randomuser.me/api/portraits/women/9.jpg'],
                ['id' => 10, 'name' => 'Lucas Visser', 'img' => 'https://randomuser.me/api/portraits/men/10.jpg'],
            ]"
    />
</x-app-layout>
