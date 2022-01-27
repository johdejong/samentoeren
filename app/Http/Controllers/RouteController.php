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
        $routes = Route::orderBy('created_at', 'desc')->paginate(10);

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
