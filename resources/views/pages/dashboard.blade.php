{{--<x-app-layout>--}}
{{--    <div>--}}
{{--        @if ($loggedInUser->email_verified != true)--}}
{{--            <p>Verifiëer uw emailadres, via de toegestuurde mail</p>--}}
{{--        @else--}}
{{--            <!-- Top 5 Matches Showcase -->--}}
{{--            <x-peopleShowcase--}}
{{--                title="Top 5 matches!"--}}
{{--                :people="[--}}
{{--                    ['id' => 1, 'name' => 'Sophie Janssen', 'img' => 'https://randomuser.me/api/portraits/women/1.jpg'],--}}
{{--                    ['id' => 2, 'name' => 'Thomas Verbeek', 'img' => 'https://randomuser.me/api/portraits/men/2.jpg'],--}}
{{--                    ['id' => 3, 'name' => 'Lisa de Vries', 'img' => 'https://randomuser.me/api/portraits/women/3.jpg'],--}}
{{--                    ['id' => 4, 'name' => 'Mark Hendriks', 'img' => 'https://randomuser.me/api/portraits/men/4.jpg'],--}}
{{--                    ['id' => 5, 'name' => 'Eva Bakker', 'img' => 'https://randomuser.me/api/portraits/women/5.jpg'],--}}
{{--                ]"--}}
{{--            />--}}

{{--            <!-- Potential Matches Showcase -->--}}
{{--            <x-peopleShowcase--}}
{{--                title="Potentiële Matches!"--}}
{{--                :people="[--}}
{{--                    ['id' => 6, 'name' => 'David Willems', 'img' => 'https://randomuser.me/api/portraits/men/6.jpg'],--}}
{{--                    ['id' => 7, 'name' => 'Nina Kuipers', 'img' => 'https://randomuser.me/api/portraits/women/7.jpg'],--}}
{{--                    ['id' => 8, 'name' => 'Jan de Boer', 'img' => 'https://randomuser.me/api/portraits/men/8.jpg'],--}}
{{--                    ['id' => 9, 'name' => 'Emma Smits', 'img' => 'https://randomuser.me/api/portraits/women/9.jpg'],--}}
{{--                    ['id' => 10, 'name' => 'Lucas Visser', 'img' => 'https://randomuser.me/api/portraits/men/10.jpg'],--}}
{{--                ]"--}}
{{--            />--}}
{{--        @endif--}}
{{--    </div>--}}
{{--</x-app-layout>--}}

<x-app-layout>
    <div>
        <!-- Top 5 Matches Showcase -->
        <x-peopleShowcase
            title="Top 5 matches!"
            :people="$people"
        />

        <!-- Potential Matches Showcase -->
        <x-peopleShowcase
            title="Potentiële Matches!"
            :people="$people"
        />
    </div>
</x-app-layout>
