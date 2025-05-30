<x-guest-layout>
    <div class="flex flex-col items-start gap-2 text-left sm:items-center sm:text-center mb-4">
        <h1 class="text-xl font-medium">Add Address</h1>
        <p class="text-muted-foreground text-sm text-balance">You need to provide your address in order to proceed</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('client.set.address', [ 'profile' => request()->attributes->get('customer')->id]) }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="address_line_1" :value="__('Address Line 1')" />
            <x-text-input id="address_line_1" placeholder="Street address line 1..." class="block mt-1 w-full" type="text" name="address_line_1" :value="old('address_line_1')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('address_line_1')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address_line_2" :value="__('Address Line 2')" />
            <x-text-input id="address_line_2" class="block mt-1 w-full" type="text" placeholder="Street address line 2..." name="address_line_2" :value="old('address_line_2')" autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('address_line_2')" class="mt-2" />
        </div>

        <div class="mt-4 flex flex-row gap-4">
            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" class="block mt-1 w-full" type="text" placeholder="City" name="city" :value="old('city')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="postal_code" :value="__('Postal Code')" />
                <x-text-input id="postal_code" class="block mt-1 w-full"  placeholder="00000" type="text" name="postal_code" :value="old('postal_code')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <div>
                <x-input-label for="state" :value="__('State / Province')" />
                <x-text-input id="state" class="block mt-1 w-full" type="text" placeholder="Province" name="state" :value="old('state')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('state')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
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
