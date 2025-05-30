<x-guest-layout>
    <div class="flex flex-col items-start gap-2 text-left mb-4">
        <h1 class="text-xl font-medium">Select Profile to continue</h1>
        <p class="text-muted-foreground text-sm text-balance">We found your multiple profiles please select one to proceed</p>
    </div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="w-full flex flex-col  divide divide-y-2 space-y-2 divide-gray-200">
        @foreach ($customers as $customer)
            <a href="{{ route('profile.index',[ 'profile' => $customer->id ]) }}" class="flex flex-col items-start bg-white gap-2 text-left rounded-2xl shadow-lg hover:shadow-inner p-4 cursor-pointer">
                <h1 class="text-xl font-medium">{{ $customer->name }}
                    @if ($customer->is_personal)
                        <span class="text-sm text-green-500"> (personal)</span>
                    @endif
                </h1>
            </a>
        @endforeach
    </div>


</x-guest-layout>
