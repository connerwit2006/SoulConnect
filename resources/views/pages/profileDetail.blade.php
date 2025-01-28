<x-app-layout>
    <!-- Person Details -->
    <x-detail-person
        :person="$person"
        :slides="$slides"
    />

    <!-- Potential Matches Showcase -->
    <x-peopleShowcase
        title="Potentiële Matches!"
        :people="$matches"
    />
</x-app-layout>
