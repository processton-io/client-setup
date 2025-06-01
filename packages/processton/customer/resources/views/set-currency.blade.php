<x-guest-layout>
    <div class="flex flex-col items-start gap-2 text-left mb-4">
        <h1 class="text-xl font-medium">Please select your currency</h1>
        <p class="text-muted-foreground text-sm text-balance"></p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full flex flex-col  divide divide-y-2 space-y-2 divide-gray-200">
        <form method="POST" action="{{ route('client.set.currency',[ 'profile' => request()->route('profile')]) }}">
        @csrf

        <div>
            <x-input-label for="company_name" :value="__('Currency')" />
            <select class="block mt-1 w-full border-gray-300 border focus:border-gray-200 focus:ring-2 focus:ring-gray-300 rounded-md shadow-sm py-2 px-4 text-sm" name="currency_id" :value="old('currency_id')" required autofocus autocomplete="currency_id" >
                <option value="">Select Currency</option>
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}" {{ old('currency_id') == $currency->id ? 'selected' : '' }}>{{ $currency->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('currency_id')" class="mt-2" />
        </div>


        <input type="hidden" name="ret_url" value="{{ request()->get('ret_url','/') }}">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
    </div>


</x-guest-layout>
