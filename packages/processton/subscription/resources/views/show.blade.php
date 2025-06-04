@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Subscription Details</h2>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $subscription->plan_name }}</h5>
            <p class="card-text">
                <strong>Status:</strong> {{ ucfirst($subscription->status) }}<br>
                <strong>Started At:</strong> {{ $subscription->created_at->format('M d, Y') }}<br>
                <strong>Next Payment:</strong> {{ $subscription->next_payment_at ? $subscription->next_payment_at->format('M d, Y') : 'N/A' }}<br>
                <strong>Amount:</strong> ${{ number_format($subscription->amount, 2) }}
            </p>
        </div>
    </div>

    @if($subscription->status === 'active')
        <form action="{{ route('subscription.cancel', $subscription->id) }}" method="POST" class="mb-3">
            @csrf
            @method('POST')
            <button type="submit" class="btn btn-danger">Cancel Subscription</button>
        </form>
    @endif

    @if($subscription->status === 'past_due')
        <form action="{{ route('subscription.pay', $subscription->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    @endif

    <a href="{{ route('subscription.index') }}" class="btn btn-secondary mt-3">Back to Subscriptions</a>
</div>
@endsection