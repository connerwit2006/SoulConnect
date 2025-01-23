<x-guest-layout>

    <!-- Sign-in Greet -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900">Word lid van SoulConnect!</h1>
        <p class="text-md text-gray-700 mt-4">Maak een account aan en start je reis naar nieuwe connecties.</p>
    </div>

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
        <!-- Gender -->
<div class="mt-4">
    <x-input-label for="gender" :value="__('Geslacht')" />
    <div class="mt-2">
        <select id="gender" name="gender" class="form-select block mt-1 w-full text-gray-600" required>
            <option value="" disabled selected hidden selected>{{ __('Kies uw Geslacht') }}</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Man') }}</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Vrouw') }}</option>
        </select>
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

            <a class="hover:underline text-sm text-gray-700 hover:text-gray-900 rounded-md focus:outline-none hover:scale-105 transition-transform" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registreer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
