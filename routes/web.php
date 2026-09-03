<?php

declare(strict_types=1);

#region USE

use Illuminate\Support\Facades\Route;
use Narsil\Base\Http\Controllers\HomeController;
use Narsil\Base\Http\Controllers\Fetch\FetchFormController;
use Narsil\Base\Http\Controllers\TanStackTables\TanStackTableDestroyController;
use Narsil\Base\Http\Controllers\TanStackTables\TanStackTableReplicateController;
use Narsil\Base\Http\Controllers\TanStackTables\TanStackTableUpdateController;

#endregion

Route::middleware([
    'web',
    'narsil',
    'auth',
    'verified',
])->prefix('narsil')->as('narsil.')->group(function ()
{
    Route::get('/', HomeController::class)
        ->name('home');

    Route::get('forms/{form}', FetchFormController::class)
        ->name('forms.fetch');


    Route::patch('tables/{table}', TanStackTableUpdateController::class)
        ->name('tables.update');
    Route::delete('tables/{table}', TanStackTableDestroyController::class)
        ->name('tables.destroy');
    Route::post('tables/{table}/replicate', TanStackTableReplicateController::class)
        ->name('tables.replicate');
});
