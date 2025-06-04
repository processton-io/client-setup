<x-app-layout>
    <div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Subscribe to Plan</h2>
        <div class="mb-4">
            <strong>Customer:</strong> {{ $customer->name }} ({{ $user->email }})
        </div>
        <div class="mb-4">
            <strong>Plan:</strong> {{ $plan->name }}<br>
            <span class="text-gray-600">Price: {{ $plan->price }} {{ $plan->currency }}</span>
        </div>
        <form method="POST" action="{{ route('processton-subscribe.index', ['planId' => $plan->id, 'profile' => $customer->id ]) }}" x-data="{ consent: false }">
            @csrf
            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" x-model="consent" class="form-checkbox" name="terms">
                    <span class="ml-2">I agree to subscribe to this plan and authorize payment.</span>
                </label>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded disabled:opacity-50" :disabled="!consent">
                Subscribe
            </button>
        </form>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
