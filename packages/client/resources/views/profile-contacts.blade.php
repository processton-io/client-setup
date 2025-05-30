<h3 class="text-lg font-semibold text-gray-800">Contacts</h3>
<ul role="list" class="divide-y divide-gray-100">
    @foreach ($customer->customerContacts as $cc )
        <li class="flex justify-between gap-x-6 py-5">
            <div class="flex min-w-0 gap-x-4">
                <img class="size-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm/6 font-semibold text-gray-900">{{$cc->contact->name}}</p>
                    <p class="mt-1 truncate text-xs/5 text-gray-500">{{$cc->contact->email}}</p>
                </div>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <p class="text-sm/6 text-gray-900">{{$cc->job_title}}</p>
                <p class="mt-1 text-xs/5 text-gray-500">{{$cc->department}}</p>
            </div>
        </li>

    @endforeach
</ul>
