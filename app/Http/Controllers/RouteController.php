<?php

namespace App\Http\Controllers;

use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;
use App\Models\Route;
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
}
