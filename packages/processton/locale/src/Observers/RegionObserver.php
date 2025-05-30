<?php
namespace Processton\Locale\Observers;

use Processton\Locale\Models\Region;
use Processton\Locale\Stats\ZoneIncident;

class RegionObserver
{
    public function created(Region $reqion): void
    {
        ZoneIncident::increase();
        // Code to run after a user is created
    }
    public function updated(Region $reqion): void
    {
        // Code to run after a user is updated
    }
    public function deleted(Region $reqion): void
    {
        ZoneIncident::decrease();
        // Code to run after a user is deleted
    }
    public function restored(Region $reqion): void
    {
        // Code to run after a user is restored
    }
    public function forceDeleted(Region $reqion): void
    {
        // Code to run after a user is permanently deleted
    }
}
