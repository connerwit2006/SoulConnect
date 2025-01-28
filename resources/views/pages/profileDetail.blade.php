<x-app-layout>
    <!-- Person Details -->
    <x-detail-person
        :person="$person"
        :slides="[
            ['image' => asset('image/Detail1.jpg')],
            ['image' => asset('image/Detail2.jpg')],
            ['image' => asset('image/Detail4.jpg')],
            ['image' => asset('image/Detail3.jpg')]
        ]"
    />

    <!-- Potential Matches Showcase -->
    <x-peopleShowcase
        title="Potentiële Matches!"
        :people="$matches"
    />
</x-app-layout>
