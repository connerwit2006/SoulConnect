<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nickname -->
        <div>
            <x-input-label for="name" :value="__('Bijnaam')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Geslacht')" />
            <div class="flex items-center mt-2">
                <!-- Optie man -->
                <label for="male" class="inline-flex items-center">
                    <input id="male" type="radio" name="gender" value="male" class="form-radio text-indigo-600" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Man') }}</span>
                </label>

                <!-- Optie vrouw -->
                <label for="female" class="inline-flex items-center ml-4">
                    <input id="female" type="radio" name="gender" value="female" class="form-radio text-indigo-600" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Vrouw') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Geboortedatum -->
        <div class="mt-4">
            <x-input-label for="geboortedatum" :value="__('Geboortedatum')" />
            <x-text-input id="geboortedatum" class="block mt-1 w-full" type="date" name="geboortedatum"
                :value="old('geboortedatum')" required autofocus min="{{ now()->subYears(100)->toDateString() }}"
                max="{{ now()->subYears(18)->toDateString() }}" />
            <x-input-error :messages="$errors->get('geboortedatum')" class="mt-2" />
        </div>

        <!-- Email adres -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Wachtwoord -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Bevestig wachtwoord -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Registratie knop -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Al Geregistreerd?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registreer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>