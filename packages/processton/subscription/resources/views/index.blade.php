<x-app-layout>
<div class="max-w-5xl mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">All Subscriptions</h1>
    <div class="space-y-4">
        @foreach($subscriptions as $subscription)
            <a href="{{ route('processton-subscribe.show', ['subscriptionId' => $subscription->id, 'profile' => $customer->id ]) }}"
               class="block bg-white rounded-lg shadow hover:shadow-lg transition p-6 border border-gray-100 hover:border-blue-400">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <div class="text-lg font-semibold text-gray-800 mb-1">{{ $subscription->item->entity->name ?? 'N/A' }}</div>
                        <div class="text-gray-500 text-sm mb-1">Subscribed By: {{ $subscription->user->name ?? 'N/A' }}</div>
                        <div class="text-gray-500 text-sm">ID: {{ $subscription->id }}</div>
                    </div>
                    <div class="flex flex-col md:items-end mt-2 md:mt-0">
                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold mb-1
                            @if($subscription->status === 'active') bg-green-100 text-green-800
                            @elseif($subscription->status === 'cancelled') bg-red-100 text-red-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ ucfirst($subscription->status) }}
                        </span>
                        <div class="text-xs text-gray-400">Started: {{ $subscription->created_at }}</div>
                        <div class="text-xs text-gray-400">Ends: {{ $subscription->ends_at }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
</x-app-layout>