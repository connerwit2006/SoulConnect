
<h3 class="mt-6 text-lg font-medium text-gray-900">{{ __('Your Gallery') }}</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
    @foreach(auth()->user()->galleries as $gallery)
        <div class="relative">
            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="User Image" class="w-full h-auto object-cover">
            <form action="{{ route('gallery.delete', $gallery->id) }}" method="POST" class="absolute top-2 right-2"
                onsubmit="return confirm('{{ __('Weet je zeker dat je deze image wilt verwijderen?') }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-2 py-1 text-xs rounded">{{ __('Delete') }}</button>
            </form>
        </div>
    @endforeach
</div>
<form action="{{ route('gallery.upload') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">{{ __('Upload Image:') }}</label>
        <input type="file" name="image" id="image" required class="mt-1 block w-full">
        
        <!-- Display the error messages using the input-error component -->
        <x-input-error class="mt-2" :messages="$errors->get('image')" />
    </div>
    <x-primary-button>{{ __('Upload') }}</x-primary-button>
</form>

