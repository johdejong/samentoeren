<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User; 
use App\Models\Location;
use App\Models\Ride;
use App\Models\Route;
use DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('backpack::dashboard', function ($view) {
            $view->with('userCount', User::count());
            $view->with('locationCount', Location::count());
            $view->with('rideCount', Ride::count());
            $view->with('routeCount', Route::count());
            $view->with('usersActions', DB::select('select * from users_actions'));
            $view->with('usersActions', DB::table('users_actions')->orderBy('created_at', 'desc')->paginate(6));
        });

        View::composer('welcome', function ($view) {
            $view->with('userCount', User::count());
            $view->with('locationCount', Location::count());
            $view->with('rideCount', Ride::count());
            $view->with('routeCount', Route::count());
            $view->with('lastRides', Ride::orderBy('start_date', 'desc')->take(3)->get());
        });
    }
}
