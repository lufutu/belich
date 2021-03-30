<?php

declare(strict_types=1);

namespace Daguilarm\Belich\Providers;

use Daguilarm\Belich\App\Http\Livewire\UpdatesUserProfileInformation;
use Illuminate\Support\ServiceProvider as Provider;
use Livewire\Livewire;

final class LivewireServiceProvider extends Provider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        Livewire::component('profile.update-profile-information-form', UpdatesUserProfileInformation::class);
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}
