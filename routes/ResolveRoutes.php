<?php

declare(strict_types=1);

/** Belich Routes */
Route::group([
    'as' => 'belich.',
    'middleware' => ['web', 'auth:sanctum', 'verified'],
], static function (): void {
    //Validation routes
    Route::get('/dashboard', function () {
        return view('belich::dashboard');
    })->name('dashboard');

    //Load all the custom routes
    if (file_exists(app_path('/Belich/Routes.php'))) {
        require_once app_path('/Belich/Routes.php');
    }
});
