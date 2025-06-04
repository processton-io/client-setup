<?php

namespace Processton\Subscription\Controllers;

use Processton\Subscription\Controllers\Controller;
use Processton\Customer\Models\Customer;
use Processton\Items\Models\SubscriptionPlan;

class WebController extends Controller
{

    public function subscribe($profile, $planId)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $plan = SubscriptionPlan::find($planId);

        return view('processton-subscription::checkout', [
            'user' => $user,
            'plan' => $plan,
        ]);
    }

    public function doSubscibe($profile, $planId)
    {
        $user = auth()->user();

        $customer = Customer::find($profile);

        $plan = SubscriptionPlan::find($planId);

        if (!$customer || !$plan) {
            return redirect()->back()->withErrors(['error' => 'Invalid profile or plan']);
        }

        // Check if the user have concented to the terms and conditions
        if (!request()->has('terms')) {
            return redirect()->back()->withErrors(['error' => 'You must agree to the terms and conditions']);
        }

        // To Do redirect for payment on call back to next steps

        // Create the subscription
        CustomerSubscription::create([
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
    }

}
