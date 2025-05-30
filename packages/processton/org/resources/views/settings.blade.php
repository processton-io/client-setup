<x-filament::page>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="submit" class="bg-white dark:bg-slate-800 shadow-md px-4 py-8 rounded">
        <div class=" grid gap-6">
            {{-- Render all fields including org_logo, org_title, org_description --}}
            @foreach ($this->form->getComponents() as $component)
                {{ $component }}
            @endforeach
        </div>
        <x-filament::button type="submit" class="mt-6">
            {{ __('Save') }}
        </x-filament::button>
    </form>
</x-filament::page>
