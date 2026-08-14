<?php

#region USE

use Illuminate\Support\Facades\Route;
use Laravel\Nightwatch\Types\Str;
use Narsil\Base\Http\Controllers\Users\Bookmarks\UserBookmarkDestroyController;
use Narsil\Base\Http\Controllers\Users\Bookmarks\UserBookmarkIndexController;
use Narsil\Base\Http\Controllers\Users\Bookmarks\UserBookmarkStoreController;
use Narsil\Base\Http\Controllers\Users\Bookmarks\UserBookmarkUpdateController;
use Narsil\Base\Http\Controllers\Users\Configurations\UserConfigurationEditController;
use Narsil\Base\Http\Controllers\Users\Configurations\UserConfigurationUpdateController;
use Narsil\Base\Http\Controllers\Users\Sessions\SessionController;
use Narsil\Base\Models\Users\UserBookmark;
use Narsil\Base\Models\Users\UserConfiguration;

#endregion

Route::middleware([
    'auth',
    'verified',
])->group(
    function ()
    {
        Route::prefix(Str::slug(UserBookmark::TABLE))->name(Str::slug(UserBookmark::TABLE) . '.')->group(function ()
        {
            Route::get('/', UserBookmarkIndexController::class)
                ->name('index');
            Route::post('/', UserBookmarkStoreController::class)
                ->name('store');
            Route::patch('/{userBookmark}', UserBookmarkUpdateController::class)
                ->name('update');
            Route::delete('/{userBookmark}', UserBookmarkDestroyController::class)
                ->name('destroy');
        });

        Route::delete('/sessions', SessionController::class)
            ->name('sessions.delete');
    }
);

Route::prefix(Str::slug(UserConfiguration::TABLE))->name(Str::slug(UserConfiguration::TABLE) . '.')->group(function ()
{
    Route::get('/', UserConfigurationEditController::class)
        ->name('edit');
    Route::post('/', UserConfigurationUpdateController::class)
        ->name('update');
});
