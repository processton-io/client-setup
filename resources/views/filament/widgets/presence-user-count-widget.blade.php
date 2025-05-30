<x-filament-widgets::widget>
    <x-filament::card wire:poll.5s>
        <div class="flex items-center gap-x-3">
            <img class="fi-avatar object-cover object-center fi-circular rounded-full h-10 w-10 fi-user-avatar" src="https://ui-avatars.com/api/?name=S+A&amp;color=FFFFFF&amp;background=09090b" alt="Avatar of Super Admin">

            <div class="flex-1">
                <h2 class="grid flex-1 text-base font-semibold leading-6 text-gray-950">
                    Users Online
                </h2>

                <p class="text-sm text-gray-500">
                    Today's Total: {{ $this->getTodayUserCount() }}
                </p>
            </div>

            <p class="my-auto">
                {{ $this->getOnlineUserCount() }}
            </a>
        </div>
    </x-filament::card>
</x-filament-widgets::widget>
