<?php

declare(strict_types=1);

/** Belich Routes */
Route::group([
    'as' => 'test.',
], static function (): void {
    Route::name('cars.index')->get('/cars', function (): void {
        return;
    });

    Route::name('cars.edit')->get('/cars/{car}/edit', function ($car): void {
        return;
    });

    Route::name('cars.create')->get('/cars/create', function (): void {
        return;
    });

    Route::name('cars.show')->get('/cars/{car}', function ($car): void {
        return;
    });
});
