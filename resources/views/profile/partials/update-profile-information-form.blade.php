<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profiel informatie') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Wijzig je profiel informatie") }}
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
                <img id="images" src="{{ asset('images/' . $user->face_card) }}" alt="Profile Image"
                    class="w-full h-full object-cover" />
            </div>
            <x-input-label for="face_card" :value="__('Afbeelding')" />
            <x-text-input id="face_card" name="face_card" type="file" class="mt-1 block w-full" :value="old('face_card', $user->face_card)" autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('face_card')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Geslacht')" />
            <div class="mt-2">
                <select id="gender" name="gender" class="form-select block mt-1 w-full text-gray-600" autofocus
                    autocomplete>
                    <option value="" disabled selected hidden>{{ __('Kies uw Geslacht') }}</option>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>{{ __('Man') }}
                    </option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                        {{ __('Vrouw') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="looking_for_gender" :value="__('Voorkeur geslacht')" />
            <div class="mt-2">
                <select id="looking_for_gender" name="looking_for_gender"
                    class="form-select block mt-1 w-full text-gray-600" autofocus autocomplete>
                    <option value="" disabled selected hidden>{{ __('Kies uw voorkeur') }}</option>
                    <option value="male" {{ old('looking_for_gender', $user->looking_for_gender) == 'male' ? 'selected' : '' }}>{{ __('Man') }}
                    </option>
                    <option value="female" {{ old('looking_for_gender', $user->looking_for_gender) == 'female' ? 'selected' : '' }}>{{ __('Vrouw') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('looking_for_gender')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="kinderen" :value="__('Heeft u kinderen?')" />
            <div class="mt-2">
                <select id="kinderen" name="kinderen" class="form-select block mt-1 w-full text-gray-600" autofocus
                    autocomplete>
                    <option value="" disabled selected hidden>{{ __('Kies een optie') }}</option>
                    <option value="yes" {{ old('kinderen', $user->kinderen) == 'yes' ? 'selected' : '' }}>{{ __('Ja') }}
                    </option>
                    <option value="no" {{ old('kinderen', $user->kinderen) == 'no' ? 'selected' : '' }}>{{ __('Nee') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('kinderen')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="kinderwens" :value="__('Heeft u een kinderwens?')" />
            <div class="mt-2">
                <select id="kinderwens" name="kinderwens" class="form-select block mt-1 w-full text-gray-600" autofocus
                    autocomplete>
                    <option value="" disabled selected hidden>{{ __('Kies een optie') }}</option>
                    <option value="yes" {{ old('kinderwens', $user->kinderwens) == 'yes' ? 'selected' : '' }}>
                        {{ __('Ja') }}
                    </option>
                    <option value="no" {{ old('kinderwens', $user->kinderwens) == 'no' ? 'selected' : '' }}>
                        {{ __('Nee') }}
                    </option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('kinderwens')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="relationship_type" :value="__('Relatie waar je voor open staat')" />
            <div class="mt-2">
                <select id="relationship_type" name="relationship_type"
                    class="form-select block mt-1 w-full text-gray-600" autofocus autocomplete>
                    <option value="" disabled selected hidden>{{ __('Relatie waar je voor open staat') }}</option>
                    <option value="friendly" {{ old('relationship_type', $user->relationship_type) == 'friendly' ? 'selected' : '' }}>{{ __('friendly') }}</option>
                    <option value="romantic" {{ old('relationship_type', $user->relationship_type) == 'romantic' ? 'selected' : '' }}>{{ __('romantic') }}</option>
                </select>
            </div>
            <x-input-error :messages="$errors->get('relationship_type')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="pets" :value="__('Huisdieren (ja of nee)')" />
            <select id="pets" name="pets" class="mt-1 block w-full" autofocus autocomplete="pets">
                <option value="yes" {{ old('pets', $user->pets) == 'yes' ? 'selected' : '' }}>Ja</option>
                <option value="no" {{ old('pets', $user->pets) == 'no' ? 'selected' : '' }}>Nee</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('pets')" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                autofocus autocomplete="name" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>


        <div>
            <x-input-label for="one_liner" :value="__('One liner')" />
            <x-text-input id="one_liner" name="one_liner" type="text" class="mt-1 block w-full" :value="old('one_liner', $user->one_liner)" autofocus autocomplete="one_liner" />
            <x-input-error class="mt-2" :messages="$errors->get('one_liner')" />
        </div>

        <div>
            <x-input-label for="dob" :value="__('Geboortedatum')" />
            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $user->dob)"
                autofocus autocomplete="dob" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
        </div>

        <div>
            <x-input-label for="nickname" :value="__('Bijnaam')" />
            <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $user->nickname)" autofocus autocomplete="nickname" readonly />
            <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
        </div>
        <div>
            <x-input-label for="postcode" :value="__('Postcode')" />
            <x-text-input id="postcode" name="postcode" type="text" class="mt-1 block w-full" :value="old('postcode', $user->postcode)" autofocus autocomplete="postcode" />
            <x-input-error class="mt-2" :messages="$errors->get('postcode')" />
        </div>
        <div>
            <x-input-label for="appreciate" :value="__('Waarderen in een relatie')" />
            <x-text-input id="appreciate" name="appreciate" type="text" class="mt-1 block w-full"
                :value="old('appreciate', $user->appreciate)" autofocus autocomplete="appreciate" />
            <x-input-error class="mt-2" :messages="$errors->get('appreciate')" />
        </div>
        <div>
            <x-input-label for="hobbies" :value="__('Hobby\'s')" />
            <x-text-input id="hobbies" name="hobbies" type="text" class="mt-1 block w-full" :value="old('hobbies', $user->hobbies)" autofocus autocomplete="hobbies" />
            <x-input-error class="mt-2" :messages="$errors->get('hobbies')" />
        </div>



        <div>
            <x-input-label for="music_styles" :value="__('Muziekstijlen')" />
            <x-text-input id="music_styles" name="music_styles" type="text" class="mt-1 block w-full"
                :value="old('music_styles', $user->music_styles)" autofocus autocomplete="music_styles" />
            <x-input-error class="mt-2" :messages="$errors->get('music_styles')" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" autofocus autocomplete="username" />
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
    <form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="image">Upload Image:</label>
            <input type="file" name="image" id="image" required>
        </div>
        <button type="submit">Upload</button>
    </form>
    <h3>Your Gallery</h3>
@foreach(auth()->user()->galleries as $gallery)
    <div>
        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="User Image" width="150">
        <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    </div>
@endforeach

</section>