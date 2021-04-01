<?php

declare(strict_types=1);

use Daguilarm\Belich\Facades\Belich;

/** Belich Routes */
Route::group([
    'middleware' => Belich::middleware(),
], static function (): void {

    //Dashboard
    Route::name('dashboard')->get('/dashboard', function () {
        return view('belich::dashboard');
    });

    //Profile
    Route::name(sprintf('%s.', Belich::pathName()) . 'profile.show')->get('/dashboard/profile', function () {
        return view('belich::profile');
    });

    //Load all the custom routes
    if (file_exists(app_path('/Belich/Routes.php'))) {
        require_once app_path('/Belich/Routes.php');
    }
});
