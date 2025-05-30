<x-guest-layout>
    <div class="flex flex-col items-start gap-2 text-left sm:items-center sm:text-center mb-4">
        <h1 class="text-xl font-medium">Add country</h1>
        <p class="text-muted-foreground text-sm text-balance">Please provide your country details</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('locale.set.country') }}">
        @csrf

        <div>
            <label class="block font-medium text-sm text-gray-700" for="country_id">Country</label>
            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full" id="country_id" name="country_id"  autofocus="autofocus" autocomplete="country_id">
                <option value="">Select a country</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
        </div>

        <input type="hidden" name="ret_url" value="{{ request()->get('ret_url','/') }}">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
