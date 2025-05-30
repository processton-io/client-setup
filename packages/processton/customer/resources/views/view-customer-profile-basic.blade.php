<div class="space-y-6">

    {{-- Grid Layout --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Company Info Card --}}
        <div class="bg-white shadow rounded-xl p-5 space-y-3">
            <h3 class="text-lg font-semibold text-gray-800">Company Info</h3>
            <div class="text-sm text-gray-700 space-y-2">
                <p class="flex flex-col space-y-1"><strong>Company:</strong> {{ $record->company['name'] ?? '' }}</p>
                <p class="flex flex-col space-y-1"><strong>Website:</strong> <a href="#" class="text-slate-500 hover:underline">{{ $record->company['website'] ?? '' }}</a></p>
                <p class="flex flex-col space-y-1"><strong>Currency:</strong> {{ optional($record->currency)->name ?? '' }}</p>
                <p class="flex flex-col space-y-1"><strong>Portal Access:</strong> {{ $record->enable_portal ? 'Enabled' : 'Disabled' }}</p>
            </div>
        </div>

        {{-- Social Accounts --}}
        <div class="bg-white shadow rounded-xl p-5 space-y-3">
            <h3 class="text-lg font-semibold text-gray-800">Social Accounts</h3>
            <div class="text-sm text-gray-700 space-y-2">
                <p class="flex flex-col space-y-1"><strong>Facebook ID:</strong> {{ $record->facebook_id ?? 'fb_001' }}</p>
                <p class="flex flex-col space-y-1"><strong>Google ID:</strong> {{ $record->google_id ?? 'google_123' }}</p>
                <p class="flex flex-col space-y-1"><strong>GitHub ID:</strong> {{ $record->github_id ?? 'gh_johndoe' }}</p>
            </div>
        </div>
    </div>

    <div class="flex w-full gap-6">
        {{-- Related Contacts --}}
        <div class="bg-white shadow rounded-xl p-5 flex-1">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Related Contacts</h3>
            <ul class="divide-y divide-gray-200">
                @forelse ($record->contacts as $contact)
                    <li class="py-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $contact->name }}</p>
                                <p class="text-sm text-gray-500">{{ $contact->email ?? 'no-email@example.com' }}</p>
                            </div>
                            <span class="text-xs text-gray-600">{{ $contact->pivot->role ?? 'Viewer' }}</span>
                        </div>
                    </li>
                @empty
                    <li class="py-3 text-sm text-gray-500">No contacts found.</li>
                @endforelse
            </ul>
        </div>

        {{-- Activity Feed (Static Placeholder) --}}
        <div class="bg-white shadow rounded-xl p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Activity Feed</h3>
            <ul class="space-y-3 text-sm text-gray-700">
                <li>📝 Created invoice #INV-001 on April 1, 2025</li>
                <li>📞 Called regarding payment issue - March 28, 2025</li>
                <li>✅ Marked project "Redesign" as complete</li>
            </ul>
        </div>
    </div>

</div>
