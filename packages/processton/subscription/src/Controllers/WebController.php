<?php

namespace Processton\Subscription\Controllers;

use Illuminate\Http\Request;
use Processton\Subscription\Controllers\Controller;
use Processton\Customer\Models\Customer;
use Processton\Items\Models\SubscriptionPlan;
use Processton\Subscription\Models\CustomerSubscription;
use Processton\Subscription\Enum\SubscriptionFrequencies;

class WebController extends Controller
{

    public function index($profile, Request $request)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile']);
        }

        $subscriptions = CustomerSubscription::where('customer_id', $customer->id)->get();

        return view('processton-subscription::index', [
            'user' => $user,
            'customer' => $customer,
            'subscriptions' => $subscriptions,
        ]);
    }

    public function show($profile, $subscriptionId)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $subscription = CustomerSubscription::find($subscriptionId);

        if (!$customer || !$subscription) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile or subscription']);
        }

        return view('processton-subscription::show', [
            'user' => $user,
            'customer' => $customer,
            'subscription' => $subscription,
        ]);
    }
    public function cancel($profile, $subscriptionId)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $subscription = CustomerSubscription::find($subscriptionId);

        if (!$customer || !$subscription) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile or subscription']);
        }

        // Cancel the subscription
        $subscription->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
        ]);

        return redirect()->route('processton-subscribe.index', ['profile' => $profile])
                         ->with('success', 'Subscription cancelled successfully');
    }

    public function subscribe($profile, $planId, Request $request)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $plan = SubscriptionPlan::find($planId);

        if (!$customer || !$plan) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile or plan']);
        }

        if ($request->method() === 'POST') {
                

            // Check if the user have concented to the terms and conditions
            if (!request()->has('terms')) {
                return redirect()->back()->withErrors(['error' => 'You must agree to the terms and conditions']);
            }

            // To Do redirect for payment on call back to next steps


            // Create the subscription
            $sub = CustomerSubscription::create([
                'user_id' => $user->id,
                'item_id' => $plan->item->id,
                'customer_id' => $customer->id,
                'status' => 'active',
                'end_date' => now()->addMonths($plan->frequency_interval),
                'cancelled_at' => null,
                'last_payment_date' => now(),
                'next_payment_date' => now()->addMonths($plan->frequency_interval),
                'trial_ends_at' => now()->addDays($plan->trial_days),
                'amount' => $plan->price,
                'currency_id' => $customer->currency_id,
                'payment_method' => [],
                'frequency' => SubscriptionFrequencies::MONTHLY,
                'frequency_interval' => 1,
            ]);

            // Redirect to subscription detail screen
            return redirect()->route('processton-subscribe.show', [
                'profile' => $profile,
                'subscriptionId' => $sub->id,
            ])->with('success', 'Subscription created successfully');

        }

        return view('processton-subscription::checkout', [
            'user' => $user,
            'customer' => $customer,
            'plan' => $plan,
        ]);
    }

    public function renew($profile, $subscriptionId)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $subscription = CustomerSubscription::find($subscriptionId);

        if (!$customer || !$subscription) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile or subscription']);
        }

        // Renew the subscription
        $subscription->update([
            'status' => 'active',
            'end_date' => now()->addMonths($subscription->frequency_interval),
            'last_payment_date' => now(),
            'next_payment_date' => now()->addMonths($subscription->frequency_interval),
        ]);

        return redirect()->route('processton-subscribe.index', ['profile' => $profile])
                         ->with('success', 'Subscription renewed successfully');

        
    }

}
