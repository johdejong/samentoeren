<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Country;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (! empty($keyword)) {
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

    public function sortByNameUp(Request $request)
    {
        $locations = Location::orderBy('name', 'asc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByNameDown(Request $request)
    {
        $locations = Location::orderBy('name', 'desc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByAddressUp(Request $request)
    {
        $locations = Location::orderBy('address', 'asc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByAddressDown(Request $request)
    {
        $locations = Location::orderBy('address', 'desc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByPostalCodeUp(Request $request)
    {
        $locations = Location::orderBy('postal_code', 'asc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByPostalCodeDown(Request $request)
    {
        $locations = Location::orderBy('postal_code', 'desc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByResidenceUp(Request $request)
    {
        $locations = Location::orderBy('residence', 'asc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByResidenceDown(Request $request)
    {
        $locations = Location::orderBy('residence', 'desc')->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByCountryUp(Request $request)
    {
        $locations = Location::with('country')
            ->orderBy(Country::select('name')
            ->whereColumn('countries.id', 'locations.country_id'), 'asc')
            ->paginate(10);

        return view('location.index', compact('locations'));
    }

    public function sortByCountryDown(Request $request)
    {
        $locations = Location::with('country')
            ->orderBy(Country::select('name')
            ->whereColumn('countries.id', 'locations.country_id'), 'desc')
            ->paginate(10);

        return view('location.index', compact('locations'));
    }
}
