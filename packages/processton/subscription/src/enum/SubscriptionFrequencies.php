<?php

namespace Processton\Subscription\Enum;

enum SubscriptionFrequencies: string
{
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
    case WEEKLY = 'weekly';
    case DAILY = 'daily';

    public function label(): string
    {
        return match ($this) {
            self::MONTHLY => 'Monthly',
            self::YEARLY => 'Yearly',
            self::WEEKLY => 'Weekly',
            self::DAILY => 'Daily',
        };
    }
}