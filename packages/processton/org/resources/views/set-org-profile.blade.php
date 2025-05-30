<x-guest-layout>


    <div class="flex flex-col items-start gap-2 text-left sm:items-center sm:text-center mb-4">
        <h1 class="text-xl font-medium">Company Information</h1>
        <p class="text-muted-foreground text-sm text-balance">Please enter your name</p>
    </div>

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf
        <div className="grid grid-cols-1 gap-4">
            @foreach ($orgSettings as $key => $orgSetting)
                <div id="{{ $orgSetting->id }}" >
                    <x-input-label id="{{ $orgSetting->id }}" for="{{ $orgSetting->org_key }}" value="{{ $orgSetting->title }}" />
                    @if ($orgSetting->type == 'string')
                        <x-text-input id="{{ $orgSetting->org_key }}" class="block mt-1 w-full" type="text" name="{{$orgSetting->org_key}}" value="{{old($orgSetting->org_key)}}" autofocus autocomplete="{{$orgSetting->org_key}}" />
                    @elseif ($orgSetting->type == 'text')
                        <x-textarea-input id="{{ $orgSetting->org_key }}" class="block mt-1 w-full" type="text" name="{{$orgSetting->org_key}}" value="{{old($orgSetting->org_key)}}" autofocus>
                        </x-textarea-input>
                    @elseif ($orgSetting->type == 'avatar')
                        <x-avatar-input id="{{ $orgSetting->org_key }}" class="block mt-1 w-full" type="text" name="{{$orgSetting->org_key}}" value="{{old($orgSetting->org_key)}}" autofocus>
                        </x-avatar-input>
                    @elseif ($orgSetting->type == 'select')

                        <x-select-input id="{{ $orgSetting->org_key }}" :options="($orgSetting->org_options ? $orgSetting->org_options : [])" class="block mt-1 w-full" type="text" name="{{$orgSetting->org_key}}" value="{{old($orgSetting->org_key)}}" autofocus />
                    @endif
                    <x-input-error :messages="$errors->get($orgSetting->org_key)" class="mt-2" />
                </div>

            @endforeach

        </div>

        <input type="hidden" name="ret_url" value="{{ request()->get('ret_url','/') }}">

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>

</x-guest-layout>
