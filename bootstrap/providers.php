<?php


return [
    App\Providers\AppServiceProvider::class,
    Processton\UserProfile\UserProfileServiceProvider::class,
    App\Providers\Filament\CrmPanelProvider::class,
    App\Providers\Filament\LeadPanelProvider::class,
    App\Providers\Filament\ContentPanelProvider::class,
    App\Providers\Filament\PosPanelProvider::class,
    App\Providers\Filament\InventoryPanelProvider::class,
    App\Providers\Filament\ServicePanelProvider::class,
    App\Providers\Filament\ShipmentPanelProvider::class,
    App\Providers\Filament\AbacusPanelProvider::class,
    App\Providers\Filament\SetUpPanelProvider::class,
    Processton\Client\ClientServicePanelProvider::class,
    Processton\Campeigns\CampeignServiceProvider::class,
    // Processton\AccessControll\AccessControllPanelProvider::class,
    // Processton\Locale\LocaleServicePanelProvider::class,
    // App\Providers\Filament\SetUpPanelProvider::class,
    // Processton\AccessControll\AccessControllPanelProvider::class,
    // Processton\Locale\LocaleServicePanelProvider::class,
];
