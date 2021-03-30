<?php

declare(strict_types=1);

/** Belich Routes */
Route::group([
    'as' => 'belich.',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
], static function (): void {

    //Dashboard
    Route::get('/dashboard', function () {
        return view('belich::dashboard');
    })->name('dashboard');

    //Profile
    Route::get('/dashboard/profile', function () {
        return view('belich::profile');
    })->name('profile.show');

    //Load all the custom routes
    if (file_exists(app_path('/Belich/Routes.php'))) {
        require_once app_path('/Belich/Routes.php');
    }
});
