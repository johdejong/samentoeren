<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Route
    Route::get('route', [\App\Http\Controllers\RouteController::class, 'index'])->name('route.frontend.index');
    Route::get('route/show/{route}', [\App\Http\Controllers\RouteController::class, 'show'])->name('route.frontend.show');
    Route::get('route/download/{route}', [\App\Http\Controllers\RouteController::class, 'download'])->name('route.frontend.download');

    // Location
    Route::get('location', [\App\Http\Controllers\LocationController::class, 'index'])->name('location.frontend.index');
    Route::get('location/show/{location}', [\App\Http\Controllers\LocationController::class, 'show'])->name('location.frontend.show');

    // Ride
    Route::get('ride', [\App\Http\Controllers\RideController::class, 'index'])->name('ride.frontend.index');
    Route::get('ride/{ride}/show', [\App\Http\Controllers\RideController::class, 'show'])->name('ride.frontend.show');
    Route::get('ride/{ride}/map/{route}', [\App\Http\Controllers\RideController::class, 'map'])->name('ride.frontend.map');
    Route::get('ride/download/{route}', [\App\Http\Controllers\RideController::class, 'download'])->name('ride.frontend.download');
    Route::get('ride/{ride}/join', [\App\Http\Controllers\RideController::class, 'join'])->name('ride.frontend.join');
    Route::get('ride/{ride}/unjoin', [\App\Http\Controllers\RideController::class, 'unjoin'])->name('ride.frontend.unjoin');
    Route::get('ride/sortByNameUp', [\App\Http\Controllers\RideController::class, 'sortByNameUp'])->name('ride.frontend.sortByNameUp');
    Route::get('ride/sortByNameDown', [\App\Http\Controllers\RideController::class, 'sortByNameDown'])->name('ride.frontend.sortByNameDown');
    Route::get('ride/sortByDistanceUp', [\App\Http\Controllers\RideController::class, 'sortByDistanceUp'])->name('ride.frontend.sortByDistanceUp');
    Route::get('ride/sortByDistanceDown', [\App\Http\Controllers\RideController::class, 'sortByDistanceDown'])->name('ride.frontend.sortByDistanceDown');
    Route::get('ride/sortByJoinUp', [\App\Http\Controllers\RideController::class, 'sortByJoinUp'])->name('ride.frontend.sortByJoinUp');
    Route::get('ride/sortByJoinDown', [\App\Http\Controllers\RideController::class, 'sortByJoinDown'])->name('ride.frontend.sortByJoinDown');
    Route::get('ride/sortByStartDateUp', [\App\Http\Controllers\RideController::class, 'sortByStartDateUp'])->name('ride.frontend.sortByStartDateUp');
    Route::get('ride/sortByStartDateDown', [\App\Http\Controllers\RideController::class, 'sortByStartDateDown'])->name('ride.frontend.sortByStartDateDown');
});

