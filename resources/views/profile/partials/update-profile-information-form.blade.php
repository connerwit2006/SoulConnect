<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <div
                class="w-32 h-32 rounded-full overflow-hidden border-2 border-gray-300 flex items-center justify-center">
                <img id="images" src="{{ asset('images/' . $user->image) }}" alt="Profile Image"
                    enctype="multipart/form-data class=" w-full h-full object-cover" />
            </div>
            <x-input-label for="image" :value="__('Afbeelding')" />
            <x-text-input id="face_card" name="face_card" type="file" class="mt-1 block w-full" :value="old('face_card', $user->image)" autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div>
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

        <div>
            <x-input-label for="looking_for_gender" :value="__('Voorkeur geslacht')" />
            <div class="mt-2">
                <select id="looking_for_gender" name="looking_for_gender"
                    class="form-select block mt-1 w-full text-gray-600" required>
                    <option value="" disabled selected hidden>{{ __('Kies uw voorkeur') }}</option>
                    <option value="male" {{ old('looking_for_gender') == 'male' ? 'selected' : '' }}>{{ __('Man') }}
                    </option>
                    <option value="female" {{ old('looking_for_gender') == 'female' ? 'selected' : '' }}>{{ __('Vrouw') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="relationship_type" :value="__('Relatie waar je voor open staat')" />
            <div class="mt-2">
                <select id="relationship_type" name="relationship_type"
                    class="form-select block mt-1 w-full text-gray-600" required>
                    <option value="" disabled selected hidden>{{ __('Kies een relatietype') }}</option>
                    <option value="serious" {{ old('relationship_type') == 'serious' ? 'selected' : '' }}>
                        {{ __('serieus') }}</option>
                    <option value="casual" {{ old('relationship_type') == 'casual' ? 'selected' : '' }}>{{ __('vriendschappelijk') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('relationship_type')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

       
        <div>
            <x-input-label for="one_liner" :value="__('One liner')" />
            <x-text-input id="one_liner" name="one_liner" type="text" class="mt-1 block w-full" :value="old('one_liner', $user->one_liner)" required autofocus autocomplete="one_liner" />
            <x-input-error class="mt-2" :messages="$errors->get('one_liner')" />
        </div>

        <div>
            <x-input-label for="dob" :value="__('Geboortedatum')" />
            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $user->dob)"
                required autofocus autocomplete="dob" />
            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
        </div>

        <div>
            <x-input-label for="nickname" :value="__('Bijnaam')" />
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" required autofocus autocomplete="nickname" />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>
        <div>
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" name="postcode" type="text" class="mt-1 block w-full" :value="old('postcode', $user->postcode)" required autofocus autocomplete="postcode" />
            <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>