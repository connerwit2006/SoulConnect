<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest focus:ring-2 focus:ring-accent hover:scale-105 transition-transform']) }}>
    {{ $slot }}
</button>
