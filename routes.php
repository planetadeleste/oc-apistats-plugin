<?php
Route::prefix('api/v1')
    ->namespace('PlanetaDelEste\ApiStats\Controllers\Api')
    ->middleware(['throttle:120,1', 'bindings'])
    ->group(
        function () {
            Route::prefix('products')
                ->name('products.')
                ->group(function () {
                    Route::get('stats', 'Products@stats')->name('stats');
                });

            Route::prefix('users')
                ->name('users.')
                ->group(function () {
                    Route::get('stats', 'Users@stats')->name('stats');
                });
        }
    );
