<?php

namespace App\Http\Controllers;

use App\Http\Requests\RideRequest;
use App\Models\Ride;
use App\Models\Route;
use App\Models\Distancecategory;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserJoined;
use App\Mail\UserUnJoined;
use App\Mail\AddedAttendee;
use App\Mail\RemovedAttendee;
use DB;

class RideController extends Controller
{
    public function index(Request $request)
    {
        $rides = Ride::orderBy('start_date', 'desc')->paginate(10); 

        return view('ride.index', compact('rides'));
    }

    public function show(Request $request, Ride $ride)
    {
        return view('ride.show', compact('ride'));
    }

    public function join(Request $request, Ride $ride, User $user)
    {
        // Selecteer aangemelde gebruiker
        $user = User::find(auth()->user()->id);

        // Voeg gebruiker toe aan de deelnemerslijst
        $ride->users()->attach(auth()->user());
      
        // Bevestiging voor gebruiker en beheerder
        Mail::to(auth()->user())
            ->queue(new UserJoined($ride, $user));
        Mail::to('johan@johanenjolanda.nl')
            ->queue(new AddedAttendee($ride, $user));

        // Neem een actie op in het databaselogboek
        $name = auth()->user()->name;
        $message = auth()->user()->name . " heeft zich aangemeld voor  $ride->name" . ".";
        $data = array(
            'name'          => $name,
            'message'       => $message,
            'created_at'    => date("Y-m-d H:i:s"),
        );
        DB::connection()->table('users_actions')->insert($data);

        return redirect()->back()
            ->with('success', 'Je bent aangemeld als deelnemer. Dit bericht wordt per email aan je bevestigd.');
    }

    public function unjoin(Request $request, Ride $ride, User $user)
    {
        // Selecteer aangemelde gebruiker
        $user = User::find(auth()->user()->id);
        
        // Verwijder gebruiker uit de deelnemerslijst
        $ride->users()->detach(auth()->user());

        // Bevestiging voor gebruiker en beheerder
        Mail::to(auth()->user())
           ->queue(new UserUnJoined($ride, $user));
        Mail::to('johan@johanenjolanda.nl')
            ->queue(new RemovedAttendee($ride, $user));

        // Neem een actie op in het databaselogboek
        $name = auth()->user()->name;
        $message = auth()->user()->name . " heeft zich afgemeld voor  $ride->name" . ".";
        $data = array(
            'name'          => $name,
            'message'       => $message,
            'created_at'    => date("Y-m-d H:i:s"),
        );
        DB::connection()->table('users_actions')->insert($data);

        return redirect()->back()
            ->with('success', 'Je bent afgemeld als deelnemer. Dit bericht wordt per e-mail aan je bevestigd.');
    }

    public function map(Request $request, Ride $ride, Route $route, Distancecategory $distancecategory)
    {
        $route = Route::find($route->id);
        $ride = Ride::find($ride->id);

        return view('ride.map', compact('route', 'ride'));
    }

    public function download(Request $request, Ride $ride, Route $route)
    {
        $route = Route::find($route->id);
        $download = 'storage/' . $route->image;

        return response()->download($download);
    }
}
