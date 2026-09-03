<?php

declare(strict_types=1);

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetCreateController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetDestroyController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetDestroyManyController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetEditController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetIndexController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetStoreController;
use Narsil\Base\Http\Controllers\Storages\Assets\AssetUpdateController;
use Narsil\Base\Models\Storages\Asset;

#endregion

Route::middleware([
    'auth',
    'verified',
])->group(
    function ()
    {
        Route::prefix(Asset::TABLE)->name(Asset::TABLE . '.')->group(function ()
        {
            Route::get('/', AssetIndexController::class)
                ->name('index');
            Route::get('/create', AssetCreateController::class)
                ->name('create');
            Route::post('/', AssetStoreController::class)
                ->name('store');
            Route::get('/{asset}/edit', AssetEditController::class)
                ->name('edit');
            Route::patch('/{asset}', AssetUpdateController::class)
                ->name('update');
            Route::delete('/{asset}', AssetDestroyController::class)
                ->name('destroy');
            Route::delete('/', AssetDestroyManyController::class)
                ->name('destroy-many');
        });
    }
);
