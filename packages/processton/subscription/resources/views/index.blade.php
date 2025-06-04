<x-app-layout>
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">All Subscriptions</h1>
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Started At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ends At</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($subscriptions as $subscription)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->plan->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                @if($subscription->status === 'active') bg-green-100 text-green-800
                                @elseif($subscription->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->created_at }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $subscription->ends_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</x-app-layout>