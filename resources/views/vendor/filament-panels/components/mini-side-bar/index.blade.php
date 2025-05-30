@php
    $panels = filament()->getPanels();
    $user = filament()->auth()->user();
    $items = filament()->getUserMenuItems();

    $profileItem = $items['profile'] ?? $items['account'] ?? null;
    $profileItemUrl = $profileItem?->getUrl();
    $profilePage = filament()->getProfilePage();
    $hasProfileItem = filament()->hasProfile() || filled($profileItemUrl);

    $logoutItem = $items['logout'] ?? null;

    $items = \Illuminate\Support\Arr::except($items, ['account', 'logout', 'profile']);
@endphp

{{-- format-ignore-start --}}
<div
    x-data="{}"
    class="overflow-x-clip flex-none bg-white border-r border-gray-200 w-12"
>
    <div
        x-data="{}"
        class="fixed top-0 left-0 flex flex-col items-center p-1 py-2 space-y-6 w-12 mt-2"
    >
        <div
            x-bind:class="{
                'h-10 w-10 flex items-center justify-center cursor-pointer rounded-lg': true,
                'bg-gray-300 hover:bg-gray-400 text-white': $store.companybar.isOpen === true,
                'bg-white hover:bg-gray-300 text-gray-950': $store.companybar.isOpen === false,
            }"
            x-on:click="$store.companybar.toggle()"
            >
            @php
                $orgSettings = request()->attributes->get('orgSettings');
                $image = $orgSettings['logo'] ?? null;
                if ($image && !(
                    str_starts_with($image, 'http://') ||
                    str_starts_with($image, 'https://') ||
                    str_starts_with($image, '/')
                )) {
                    $image = asset('storage/' . $image);
                }
            @endphp
            @if($image)
                <img
                    alt="Company Logo"
                    src="{{ $image }}"
                    class="h-8 w-8 mx-auto"
                />
            @else
                <img
                    alt="Company Logo"
                    src="/img/tenants.png"
                    class="h-8 w-8 mx-auto"
                />
            @endif
        </div>
        <div
            x-bind:class="{
                'h-8 w-8 flex items-center justify-center cursor-pointer rounded-lg': true,
                'bg-gray-300 hover:bg-gray-400 text-white': $store.panelsbar.isOpen === true,
                'bg-white hover:bg-gray-300 text-gray-950': $store.panelsbar.isOpen === false,
            }"
            x-on:click="$store.panelsbar.toggle()"
            >
            <img
                alt=""
                src="/img/apps.png"
                class="h-6 w-6 mx-auto"
            />
        </div>
    </div>
    <div
        x-data="{}"
        class="fixed bottom-0 left-0 flex flex-col items-center p-1 py-2 space-y-2"
    >
        <div
            x-bind:class="{
                'h-10 w-10 flex items-center justify-center cursor-pointer rounded-full': true,
                'bg-gray-300 hover:bg-gray-400 text-white': $store.providerbar.isOpen === true,
                'bg-white hover:bg-gray-300 text-gray-950': $store.providerbar.isOpen === false,
            }"
            x-on:click="$store.providerbar.toggle()"
            >
            <img
                alt=""
                src="/img/logo.png"
                class="h-8 w-8 mx-auto"
            />
        </div>
        <a
            x-bind:class="{
                'h-10 w-10 flex items-center justify-center cursor-pointer rounded-full': true,
                'bg-gray-300 hover:bg-gray-400 text-white': $store.userbar.isOpen === true,
                'bg-white hover:bg-gray-300 text-gray-950': $store.userbar.isOpen === false,
            }"
            href={{ route('filament.profile.home')}}
            >
            <x-filament-panels::avatar.user :user="$user" />
        </a>
    </div>
</div>
<div
    x-data="{}"
    x-show="$store.companybar.isOpen"
    style="display: none;"
    class="overflow-x-clip flex-none bg-white border-r border-gray-200 h-screen w-72"
>
    <div class="flex h-12 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 md:px-4 lg:px-6">
        <div class="me-6 flex">
            <div class="fi-logo text-md leading-5 flex items-center gap-2 tracking-tight text-gray-950">
                <img alt="Company Info" src="/img/info.png" style="height: 1.5rem;" class="fi-logo">
                Company Info
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-2 px-4 py-4">
        <div class="w-full flex flex-col space-y-1">
            <img alt="Company Xyz" src="/img/tenants.png"  class="w-24 h-24 border border-gray-200 rounded-lg shadow-sm">
            <span class="text-lg font-bold">Company Xyz</span>
            <p class="text-sm line-clamp-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam debitis labore consectetur voluptatibus mollitia dolorem veniam omnis ut quibusdam minima sapiente repellendus asperiores explicabo, eligendi odit, dolore similique fugiat dolor, doloremque eveniet. Odit, consequatur. Ratione voluptate exercitationem hic eligendi vitae animi nam in, est earum culpa illum aliquam.</p>
        </div>
        <div class="w-full flex flex-col">
            <div>
                <span class="text-md font-bold">Currencies</span>
            </div>
            <div>
                <span class="text-xs p-0.5 px-1 border border-green-900 bg-green-400 text-green-900 rounded-sm">PKR</span>
                <span class="text-xs p-0.5 px-1 border border-indigo-900 bg-indigo-400 text-indigo-900 rounded-sm">USD</span>
            </div>
        </div>
        <div class="w-full flex flex-col">
            <div>
                <span class="text-md font-bold">Financial Year</span>
            </div>
            <div>
                <span class="text-xs p-0.5 px-1 border border-green-900 bg-green-400 text-green-900 rounded-sm">June - July</span>
            </div>
        </div>
    </div>

</div>
<div
    x-data="{}"
    x-show="$store.panelsbar.isOpen"
    style="display: none;"
    class="overflow-x-clip flex-none bg-white border-r border-gray-200 h-screen w-72"
>
    <div class="flex h-12 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 md:px-4 lg:px-6">
        <div class="me-6 flex">
            <div class="fi-logo text-md leading-5 flex items-center gap-2 tracking-tight text-gray-950">
                <img alt="Apps" src="/img/apps.png" style="height: 1.5rem;" class="fi-logo">
                Apps
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-6 p-4">
        @foreach ($panels as $panel)
            @if(!in_array($panel->getId(),['profile']))
            <a href="/{{ $panel->getPath() }}" class="hover:bg-gray-100 flex flex-col items-center justify-center text-center text-xs cursor-pointer rounded-lg py-6">
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
<div
    x-data="{}"
    x-show="$store.providerbar.isOpen"
    style="display: none;"
    class="overflow-x-clip flex-none bg-white border-r border-gray-200 h-screen w-72"
>
    <div class="flex h-12 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 md:px-4 lg:px-6">
        <div class="me-6 flex">
            <div class="fi-logo text-md leading-5 flex items-center gap-2 tracking-tight text-gray-950">
                <img alt="Company Info" src="/img/developed-by.png" style="height: 1.5rem;" class="fi-logo">
                Developed By
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-4 px-4 py-4">
        <div class="w-full flex flex-row space-y-1 space-x-2 items-center">
            <img alt="Processton" src="/img/logo.png"  class="w-12 h-12 ">
            <span class="text-xl font-bold">Processton</span>
        </div>
        <div class="w-full flex flex-col space-y-1">
            <p class="text-sm line-clamp-3">Here are some helpfull links to help you out.</p>
        </div>
        <div class="w-full flex flex-col">
            <a class="text-sm bg-slate-800 flex-1 flex flex-row items-center space-x-2 text-slate-100 px-3 py-2 rounded-md" href="https://processton.com" target="_blank">
                <x-fas-users class="flex-0 h-4 w-4" />
                <span class="text-md font-bold">Documentation</span>
            </a>
        </div>
    </div>

</div>
<div
    x-data="{}"
    x-show="$store.userbar.isOpen"
    style="display: none;"
    class="overflow-x-clip flex-none bg-white border-r border-gray-200 h-screen w-72"
>
    <div class="flex h-12 items-center gap-x-4 bg-white px-4 shadow-sm ring-1 ring-gray-950/5 md:px-4 lg:px-6">
        <div class="me-6 flex">
            <div class="fi-logo text-md leading-5 flex items-center gap-2 tracking-tight text-gray-950">
                <img alt="Profile" src="/img/profile.png" style="height: 1.5rem;" class="fi-logo">
                Profile
            </div>
        </div>
    </div>
    <div class="flex flex-col space-y-2 px-4 py-4">
        <div class="flex justify-center px-5">
            <img class="h-32 w-32 bg-white p-2 rounded-full" src={{filament()->getUserAvatarUrl($user)}} alt="" />
        </div>
        <div class=" ">
            <div class="text-center px-4">
                <h2 class="text-gray-800 text-3xl font-bold">{{ $user->name }}</h2>
                <a class="text-gray-400 mt-2 hover:text-blue-500" href="https://www.instagram.com/immohitdhiman/" target="BLANK()">@immohitdhiman</a>
                <p class="mt-2 text-gray-500 text-sm line-clamp-3">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </p>
            </div>

        </div>
    </div>

</div>
{{-- format-ignore-end --}}
