<?php

use App\Http\Controllers\RouteCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(array_merge((array) config('backpack.base.web_middleware', 'web'), (array) config('backpack.base.middleware_key', 'admin')))->namespace('App\Http\Controllers\Admin')->group([
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ), ], function () { // custom admin routes
        Route::crud('type', 'TypeCrudController');
        Route::crud('status', 'StatusCrudController');
        Route::crud('ride', 'RideCrudController');
        Route::crud('country', 'CountryCrudController');
        Route::crud('location', 'LocationCrudController');
        Route::crud('user', 'UserCrudController');
        Route::crud('route', 'RouteCrudController');
        Route::crud('distancecategory', 'DistancecategoryCrudController');
        Route::crud('residence', 'ResidenceCrudController');

        Route::get('route/{id}/kaart', [RouteCrudController::class, 'kaart']);
        Route::get('route/{id}/download', [RouteCrudController::class, 'download']);
    }); // this should be the absolute last line of this file
