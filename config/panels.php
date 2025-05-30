<?php

use App\Http\Middleware\UserMustHaveAddress;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Processton\Locale\Middleware\UserMustHaveAddress as MiddlewareUserMustHaveAddress;
use Processton\Locale\Middleware\UserMustHaveCountry;
use Processton\Org\Middleware\OrgMustBeInstalled;
use Processton\Org\Middleware\OrgMustHaveBasicProfile;
use Processton\Org\Middleware\OrgMustHaveFinancialProfile;

return [

    'middleware' => [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
            OrgMustBeInstalled::class,
            OrgMustHaveBasicProfile::class,
            OrgMustHaveFinancialProfile::class,
        ],
        'panel' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
            MiddlewareUserMustHaveAddress::class,
        ],
        'api' => [],
        'auth' => [
            Authenticate::class,
        ],
    ],

    'locale' => [
        'enabled' => false,
        'middleware' => [
            'web' => [
            ],
            'panel' => [
            ],
            'api' => [

            ],
            'auth' => [
            ],
        ],
        'data' => [
            // Used for addresses mapping
            'models_mapping' => [
                'User' => \App\Models\User::class,
            ],
        ],
        'config' => [
            'currency' => [
                'label' => 'Currency',
                'plural_label' => 'Currencies',
                'navigation_label' => 'Currency',
                'navigation_icon' => 'ri-coin-line',
                'group_label' => 'Locale',
                'slug' => 'currencies',
                'sort' => 1,
            ],
            'currency_conversion' => [
                'label' => 'Currency Conversion',
                'plural_label' => 'Currency Conversions',
                'navigation_label' => 'Currency Conversion',
                'navigation_icon' => 'polaris-currency-convert-icon',
                'group_label' => 'Locale',
                'slug' => 'currency-conversion',
                'sort' => 1,
            ],
            'regions' => [
                'label' => 'Region',
                'plural_label' => 'Regions',
                'navigation_label' => 'Regions',
                'navigation_icon' => 'mdi-spider-web',
                'group_label' => 'Locale',
                'slug' => 'regions',
                'sort' => 2,
            ],
            'countries' => [
                'label' => 'Country',
                'plural_label' => 'Countries',
                'navigation_label' => 'Countries',
                'navigation_icon' => 'heroicon-s-flag',
                'group_label' => 'Locale',
                'slug' => 'countries',
                'sort' => 3,
            ],
            'zones' => [
                'label' => 'Zone',
                'plural_label' => 'Zones',
                'navigation_label' => 'Zones',
                'navigation_icon' => 'majestic-map-marker-path-line',
                'group_label' => 'Locale',
                'slug' => 'zones',
                'sort' => 4,
            ],
            'cities' => [
                'label' => 'Cities',
                'plural_label' => 'cities',
                'navigation_label' => 'Cities',
                'navigation_icon' => 'solar-city-line-duotone',
                'group_label' => 'Locale',
                'slug' => 'cities',
                'sort' => 5,
            ],
            'addresses' => [
                'label' => 'Address',
                'plural_label' => 'Addresses',
                'navigation_label' => 'Addresses',
                'navigation_icon' => 'heroicon-o-currency-dollar',
                'group_label' => 'Locale',
                'slug' => 'addresses',
                'sort' => 6,
            ]
        ]

    ],

    'access-controll' => [
        'enabled' => false,
        'middleware' => [
            'web' => [
            ],
            'panel' => [
            ],
            'api' => [],
            'auth' => [
            ],
        ],
        'data' => [

            'super_admin' => 'Super Admins',

            'admin_models' => [
                App\Models\User::class,
                \Processton\AccessControll\Models\Role::class,
                \Processton\Locale\Models\Currency::class,
                \Processton\Locale\Models\City::class,
                \Processton\Locale\Models\Country::class,
                \Processton\Locale\Models\Region::class,
                \Processton\Locale\Models\Zone::class,
                \Processton\Locale\Models\Address::class,
            ],

            'ignore_models' => [],

            'any_models' => [],

            'panels' => [
                [
                    'name' => 'Setup',
                    'models' => [
                        'Currency' => \Processton\Locale\Models\Currency::class,
                        'City' => \Processton\Locale\Models\City::class,
                        'Country' => \Processton\Locale\Models\Country::class,
                        'Region' => \Processton\Locale\Models\Region::class,
                        'Zone' => \Processton\Locale\Models\Zone::class,
                        'Address' => \Processton\Locale\Models\Address::class,
                        'Users' => App\Models\User::class,
                        'Roles' => \Processton\AccessControll\Models\Role::class,
                    ],
                ],
            ]

        ],
        'config' => [
            'users' => [
                'label' => 'User',
                'plural_label' => 'Users',
                'navigation_label' => 'User',
                'navigation_icon' => 'fas-users',
                'group_label' => 'Access Control',
                'slug' => 'users',
                'sort' => 1,
            ],
            'roles' => [
                'label' => 'Role',
                'plural_label' => 'Roles',
                'navigation_label' => 'Roles',
                'navigation_icon' => 'iconpark-group',
                'group_label' => 'Access Control',
                'slug' => 'roles',
                'sort' => 2,
            ],

        ]

    ],

];
