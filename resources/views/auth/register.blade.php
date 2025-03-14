<x-guest-layout>

    <!-- Sign-in Greet -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-gray-900">Word lid van SoulConnect!</h1>
        <p class="text-md text-gray-700 mt-4">Maak een account aan en start je reis naar nieuwe connecties.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
    <form action="{{ route('storeUser') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mt-2">
            <x-input-label for="name" :value="__('Gebruikersnaam')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Facecard -->
        <div class="mt-2">
            <x-input-label for="facecard" :value="__('Upload een profielfoto')" />
            <input id="facecard" class="block mt-1 w-full text-gray-600" type="file" name="facecard" />
            <x-input-error :messages="$errors->get('facecard')" class="mt-2" />
        </div>
        <!-- Gender -->
        <div class="mt-2">
            <x-input-label for="gender" :value="__('Geslacht')" />
            <div class="mt-2">
                <select id="gender" name="gender" class="form-select block mt-1 w-full text-gray-600" required>
                    <option value="" disabled selected hidden>{{ __('Kies uw Geslacht') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Man') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Vrouw') }}</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>
        <!-- Looking for Gender -->
        <div class="mt-2">
            <x-input-label for="looking_for_gender" :value="__('Voorkeur geslacht')" />
            <select id="looking_for_gender" name="looking_for_gender" class="form-select block mt-1 w-full text-gray-600"
                required>
                <option value="" disabled selected hidden>{{ __('Kies uw voorkeur') }}</option>
                <option value="male" {{ old('looking_for_gender') == 'male' ? 'selected' : '' }}>{{ __('Man') }}</option>
                <option value="female" {{ old('looking_for_gender') == 'female' ? 'selected' : '' }}>{{ __('Vrouw') }}
                </option>
            </select>
            <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
        </div>
        <div class="mt-2">
            <x-input-label for="relationship_type" :value="__('Relatie waar je voor open staat')" />
            <select id="relationship_type" name="relationship_type" class="form-select block mt-1 w-full text-gray-600" required>
                <option value="" selected disabled>{{ __('Kies een relatietype') }}</option>
                <option value="friendly" {{ old('relationship_type') == 'friendly' ? 'selected' : '' }}>{{ __('Vriendelijk') }}</option>
                <option value="romantic" {{ old('relationship_type') == 'romantic' ? 'selected' : '' }}>{{ __('Romantisch') }}</option>
            </select>
            <x-input-error :messages="$errors->get('relationship_type')" class="mt-2" />
        </div>
         <!-- One-liner -->
         <div class="mt-2">
            <x-input-label for="one_liner" :value="__('One liner')" />
            <x-text-input id="one_liner" class="block mt-1 w-full" type="text" name="one_liner" :value="old('one_liner')"
                required />
            <x-input-error :messages="$errors->get('one_liner')" class="mt-2" />
        </div>
        <div class="mt-2">
            <x-input-label for="dob" :value="__('Geboortedatum')" />
            <x-text-input id="dob" class="block mt-1 w-full" type="date" name="dob" :value="old('dob')" required />
            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
        </div>
        <!-- Nickname -->
        <div class="mt-2">
            <x-input-label for="nickname" :value="__('Bijnaam')" />
            <x-text-input id="nickname" class="block mt-1 w-full" type="text" name="nickname" :value="old('nickname')"
                required autofocus autocomplete="nickname" />
            <x-input-error :messages="$errors->get('nickname')" class="mt-2" />
        </div>
        <!-- Email -->
        <div class="mt-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Postcode -->
        <div class="mt-2">
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" class="block mt-1 w-full" type="text" name="postcode" :value="old('postcode')"
                required />
            <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="mt-2">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-2">
            <x-input-label for="password_confirmation" :value="__('Bevestig Wachtwoord')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>



        <div class="mt-2">
            <x-input-label for="appreciate" :value="__('Waarderen in een relatie')" />
            <x-text-input id="appreciate" class="block mt-1 w-full" type="text" name="appreciate"
                :value="old('appreciate')" required />
            <x-input-error :messages="$errors->get('appreciate')" class="mt-2" />
        </div>
        <!-- Looking for -->
        <div class="mt-2">
            <x-input-label for="looking_for" :value="__('Wat zoek je in een partner?')" />
            <x-text-input id="looking_for" class="block mt-1 w-full" type="text" name="looking_for"
                :value="old('looking_for')" required />
            <x-input-error :messages="$errors->get('looking_for')" class="mt-2" />
        </div>

        <!-- Terms -->
        <div class="mt-2">
            <label class="inline-flex items-center">
                <input type="checkbox" name="terms" value="1" required class="form-checkbox text-accent">
                <a href="/terms" class="ml-2 text-sm text-gray-600 md:hover:underline md:hover:text-accent">{{ __('Ik ga akkoord met de voorwaarden') }}</a>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <!-- Registratie knop -->
        <div class="flex items-center justify-end mt-4">
            <a class="hover:underline text-sm text-gray-700 hover:text-gray-900 rounded-md focus:outline-none hover:scale-105 transition-transform" href="{{ route('login') }}">
                {{ __('Al Geregistreerd?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registreer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
