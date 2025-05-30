<x-guest-layout>
    <div class="flex flex-col items-start gap-2 text-left sm:items-center sm:text-center mb-4">
        <h1 class="text-xl font-medium">Create an account</h1>
        <p class="text-muted-foreground text-sm text-balance">Enter your details below to create your account</p>
    </div>
    <form method="POST" class="flex flex-col gap-6" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div class="grid gap-2">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input 
                id="name" 
                class="block mt-1 w-full" 
                type="text" 
                name="name" 
                placeholder="Full name"
                :value="old('name')" 
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="grid gap-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input 
                id="email" 
                class="block mt-1 w-full" 
                placeholder="email@example.com" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid gap-2">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                placeholder="Password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div  class="grid gap-2">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password"
                placeholder="Confirm password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="flex-1 w-full text-center">
                {{ __('Create account') }}
            </x-primary-button>
        </div>

        <div class="text-center w-full">
                <span class="text-gray-500">Already have an account?</span>
                <a class="border-b border-dotted hover:border-solid hover:border-gray-800" href="{{ route('login') }}">
                    {{ __('Log in') }}
                </a>
        </div>
    </form>
</x-guest-layout>
