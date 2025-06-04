@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Subscriptions</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Plan</th>
                <th>Status</th>
                <th>Started At</th>
                <th>Ends At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->user->name ?? 'N/A' }}</td>
                    <td>{{ $subscription->plan->name ?? 'N/A' }}</td>
                    <td>{{ $subscription->status }}</td>
                    <td>{{ $subscription->created_at }}</td>
                    <td>{{ $subscription->ends_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection