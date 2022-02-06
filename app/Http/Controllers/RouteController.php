<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Models\Route;
use App\Models\Residence;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');

        if (!empty($keyword)) {
            $routes = Route::where('name', 'LIKE', "%$keyword%")
                ->orWhere('distance', '<=', "$keyword")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orderBy('name', 'asc')
                ->paginate(10);
        } else {
            $routes = Route::orderBy('name', 'asc')->paginate(10);
        }

        return view('route.index', compact('routes'));
    }

    public function show(Request $request, Route $route)
    {
        return view('route.show', compact('route'));
    }    

    public function download(Request $request, Route $route)
    {
        $route = Route::find($route->id);
        $download = 'storage/' . $route->image;

        return response()->download($download);
    }

    public function sortByNameUp(Request $request)
    {
        $routes = Route::orderBy('name', 'asc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByNameDown(Request $request)
    {
        $routes = Route::orderBy('name', 'desc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByDescriptionUp(Request $request)
    {
        $routes = Route::orderBy('name', 'asc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByDescriptionDown(Request $request)
    {
        $routes = Route::orderBy('name', 'desc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByDistanceUp(Request $request)
    {
        $routes = Route::orderBy('distance', 'asc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByDistanceDown(Request $request)
    {
        $routes = Route::orderBy('distance', 'desc')->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByStartResidenceUp(Request $request)
    {
        $routes = Route::with('start_residence')
            ->orderBy(Residence::select('residence')
            ->whereColumn('residences.id', 'routes.start_residence_id'), 'asc')
            ->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByStartResidenceDown(Request $request)
    {
        $routes = Route::with('start_residence')
            ->orderBy(Residence::select('residence')
            ->whereColumn('residences.id', 'routes.start_residence_id'), 'desc')
            ->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByFinishResidenceUp(Request $request)
    {
        $routes = Route::with('finish_residence')
            ->orderBy(Residence::select('residence')
            ->whereColumn('residences.id', 'routes.start_residence_id'), 'asc')
            ->paginate(10);
        return view('route.index', compact('routes'));
    }

    public function sortByFinishResidenceDown(Request $request)
    {
        $routes = Route::with('finish_residence')
            ->orderBy(Residence::select('residence')
            ->whereColumn('residences.id', 'routes.start_residence_id'), 'desc')
            ->paginate(10);
        return view('route.index', compact('routes'));
    }
}