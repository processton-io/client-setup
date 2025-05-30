<x-guest-layout>

    <div class="flex flex-col items-start gap-2 text-left sm:items-center sm:text-center mb-6">
        <h1 class="text-xl font-medium">Log in to your account</h1>
        <p class="text-muted-foreground text-sm text-balance">Enter your email and password below to log in</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" class="flex flex-col gap-6" action="{{ route('login') }}">
        @csrf

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
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid gap-2">
            <div class="flex flex-col sm:flex-row w-full">
                <x-input-label for="password" class="flex-1" :value="__('Password')" />
                @if (Route::has('password.request'))
                    <a class="hidden sm:block border-b border-dotted hover:border-solid hover:border-gray-800 text-xs" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-text-input 
                id="password" 
                class="block mt-1 w-full"
                type="password"
                placeholder="Password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            
            <div class="flex sm:hidden w-full">
                @if (Route::has('password.request'))
                    <a class="border-b border-dotted hover:border-solid hover:border-gray-800 text-xs" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-gray-600 shadow-sm focus:ring-gray-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button class="flex-1 w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center w-full">
            @if (Route::has('register'))
                <span class="text-gray-500">Don't have an account?</span>
                <a class="border-b border-dotted hover:border-solid hover:border-gray-800" href="{{ route('register') }}">
                    {{ __('Signup') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>
