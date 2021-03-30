<?php

use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Http\Controllers\CurrentTeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\ApiTokenController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TeamController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;
use Laravel\Jetstream\Http\Controllers\TeamInvitationController;
use Laravel\Jetstream\Jetstream;

Route::group([
        'as' => 'belich.',
        'middleware' => config('jetstream.middleware', ['web']),
    ], function () {
        if (Jetstream::hasTermsAndPrivacyPolicyFeature()) {
            Route::get(config('belich.path') . '/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
            Route::get(config('belich.path') . '/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');
        }

        Route::group(['middleware' => ['auth', 'verified']], function () {
            // User & Profile...
            Route::get(config('belich.path') . '/user/profile', [UserProfileController::class, 'show'])
                        ->name('profile.show');

            // API...
            if (Jetstream::hasApiFeatures()) {
                Route::get(config('belich.path') . '/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            }

            // Teams...
            if (Jetstream::hasTeamFeatures()) {
                Route::get(config('belich.path') . '/teams/create', [TeamController::class, 'create'])->name('teams.create');
                Route::get(config('belich.path') . '/teams/{team}', [TeamController::class, 'show'])->name('teams.show');
                Route::put(config('belich.path') . '/current-team', [CurrentTeamController::class, 'update'])->name('current-team.update');

                Route::get(config('belich.path') . '/team-invitations/{invitation}', [TeamInvitationController::class, 'accept'])
                            ->middleware(['signed'])
                            ->name('team-invitations.accept');
            }
        });
});
