<x-app-layout>
    <x-slot name="header">
        Routes
    </x-slot>

    <style>
        @media only screen and (max-width: 780px) {
		.hideOnMobile{
			display: none;
		    }
	    }
    </style>

    <x-errors class="mb-4" :errors="$errors" />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <div class="w-100">
                <form method="GET" action="{{ url('route') }}" accept-charset="UTF-8" class="form-inline" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Zoeken..."> 
                        <span class="input-group-btn">
                            <button class="btn btn-primary ml-1" type="submit">
                                <i class="fas fa-search fa-lg fa-fw"></i>
                            </button>
                        </span>
                    </div> 
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                Naam 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByNameUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByNameDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Omschrijving 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByDescriptionUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByDescriptionDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th class="text-end" scope="col">
                                Afstand                                 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByDistanceUp') }}"><i class="las la-sort-up fa-lg"></i></a>
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByDistanceDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Vertrek 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByStartResidenceUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByStartResidenceDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Aankomst 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByFinishResidenceUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\RouteController@sortByFinishResidenceDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $route)
                            <tr>     
                                <td><a href="{{ action('App\Http\Controllers\RouteController@show', $route->id) }}">{{ $route->name }}</a></td>
                                <td class="hideOnMobile">{{ $route->description }}</td>
                                <td class="text-end">{{ $route->distance }} km</td>
                                <td class="hideOnMobile">{{ $route->start_residence->residence }}</td>
                                <td class="hideOnMobile">{{ $route->finish_residence->residence }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $routes->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>