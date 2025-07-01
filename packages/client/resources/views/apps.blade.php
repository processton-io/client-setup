<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="flex-none bg-white"
            >
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 place-items-center p-4">
                    @foreach ($panels as $panel)
                        @if(!in_array($panel->getId(),['profile']))
                        <a href="{{ $panel->getPath() }}" class="w-full hover:bg-gray-100 flex flex-col items-center justify-center text-center text-xs cursor-pointer rounded-lg py-6">
                            <img
                                alt="{{ $panel->getBrandName() }}"
                                src="{{ $panel->getBrandLogo() }}"
                                class="h-12 w-12 mx-auto mb-2"
                            />
                            <span>{{ $panel->getBrandName() }}</span>
                        </a>
                        @endif
                    @endforeach
                    <a></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>