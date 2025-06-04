<x-app-layout>
<div class="max-w-xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-6 text-center">Subscription Details</h2>
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h5 class="text-lg font-semibold mb-2">{{ $subscription->plan_name }}</h5>
        <p class="mb-2">
            <span class="font-medium">Status:</span>
            <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                @if($subscription->status === 'active') bg-green-100 text-green-800
                @elseif($subscription->status === 'past_due') bg-yellow-100 text-yellow-800
                @elseif($subscription->status === 'cancelled') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($subscription->status) }}
            </span>
        </p>
        <p class="mb-1"><span class="font-medium">Started At:</span> {{ $subscription->created_at->format('M d, Y') }}</p>
        <p class="mb-1"><span class="font-medium">Next Payment:</span> {{ $subscription->next_payment_at ? $subscription->next_payment_at->format('M d, Y') : 'N/A' }}</p>
        <p><span class="font-medium">Amount:</span> ${{ number_format($subscription->amount, 2) }}</p>
    </div>

    @if($subscription->status === 'active')
        <form action="{{ route('processton-subscribe.cancel', ['subscriptionId' => $subscription->id, 'profile' => $customer->id ]) }}" method="POST" class="mb-3">
            @csrf
            @method('POST')
            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">Cancel Subscription</button>
        </form>
    @endif

    @if($subscription->status === 'past_due')
        <form action="{{ route('processton-subscribe.renew', ['subscriptionId' => $subscription->id, 'profile' => $customer->id ]) }}" method="POST">
            @csrf
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">Pay Now</button>
        </form>
    @endif

    <a href="{{ route('processton-subscribe.index', ['profile' => $customer->id ]) }}" class="block text-center mt-6 text-gray-600 hover:text-gray-900 underline">Back to Subscriptions</a>
</div>
</x-app-layout>