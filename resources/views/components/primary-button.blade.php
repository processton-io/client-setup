<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-4 py-2 bg-gray-800 border border-transparent rounded-md text-sm text-white tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 text-center']) }}>
    {{ $slot }}
</button>
