<x-guest-layout>
    <div class="flex flex-col items-start gap-2 sm:items-center md:text-left mb-4">
        <h1 class="text-xl font-medium">Company Information</h1>
        <p class="text-muted-foreground text-sm text-balance">Please enter your company name</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    @if($company_profile_allowed || $can_create_personal_profile)
    <form method="POST" action="{{ route('processton-company.set.company') }}">
        @csrf
        @if($company_profile_allowed)
        <div id="company-name-field">
            <x-input-label id="company_name_field" for="company_name" :value="__('Company Name')" />
            <x-text-input id="company_name" placeholder="your company name..." class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="company_name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>
        @endif
        @if($can_create_personal_profile)
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="personal_profile" class="inline-flex items-center">
                <input id="personal_profile" type="checkbox" class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500" name="personal_profile" {{ old('personal_profile') ? 'checked' : '' }} onchange="toggleCompanyNameField()">
                <span class="ms-2 text-sm text-gray-600">{{ __('I am signing up my personal profile') }}</span>
            </label>
        </div>
        @endif

        <input type="hidden" name="ret_url" value="{{ request()->get('ret_url','/') }}">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        function toggleCompanyNameField() {
            const personalProfileCheckbox = document.getElementById('personal_profile');
            const companyNameInput = document.getElementById('company_name');
            const companyNameContainer = document.getElementById('company-name-field');
            const companyNameLabel = document.getElementById('company_name_field');
            if (personalProfileCheckbox.checked) {
                companyNameInput.disabled = true;
                companyNameInput.classList.add('cursor-not-allowed');
                companyNameContainer.classList.add('opacity-50');
                companyNameContainer.classList.add('text-gray-500');
                companyNameContainer.classList.add('cursor-not-allowed');
                companyNameLabel.classList.add('text-gray-500');
                companyNameLabel.classList.add('cursor-not-allowed');
            } else {
                companyNameInput.disabled = false;
                companyNameInput.classList.remove('cursor-not-allowed');
                companyNameContainer.classList.remove('opacity-50');
                companyNameContainer.classList.remove('text-gray-500');
                companyNameContainer.classList.remove('cursor-not-allowed');
                companyNameLabel.classList.remove('text-gray-500');
                companyNameLabel.classList.remove('cursor-not-allowed');
            }
        }

        // Initialize the field state on page load
        document.addEventListener('DOMContentLoaded', () => {
            toggleCompanyNameField();
        });
    </script>
    @else
    <div class="text-center">
        <p class="text-muted-foreground text-lg">You are not allowed to create new profile.</p>
    </div>
    @endif
</x-guest-layout>
