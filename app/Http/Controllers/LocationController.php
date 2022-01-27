<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $locations = Location::orderBy('postal_code', 'asc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function show(Request $request, Location $location)
    {
        return view('location.show', compact('location'));
    }
}
