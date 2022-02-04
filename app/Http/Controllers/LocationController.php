<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $locations = Location::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address', 'LIKE', "%$keyword%")
                ->orWhere('postal_code', 'LIKE', "%$keyword%")
                ->orWhere('residence', 'LIKE', "%$keyword%")
                ->orderBy('postal_code', 'asc')
                ->paginate(10);
        } else {
            $locations = Location::orderBy('postal_code', 'asc')->paginate(10);
        }

        return view('location.index', compact('locations'));
    }

    public function show(Request $request, Location $location)
    {
        return view('location.show', compact('location'));
    }
}
