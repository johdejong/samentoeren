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
                            <th scope="col">Naam</th>
                            <th scope="col" class="hideOnMobile">Omschrijving</th>
                            <th scope="col">Afstand</th>
                            <th scope="col" class="hideOnMobile">Vertrek</th>
                            <th scope="col" class="hideOnMobile">Aankomst</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $route)
                            <tr>     
                                <td><a href="{{ action('App\Http\Controllers\RouteController@show', $route->id) }}">{{ $route->name }}</a></td>
                                <td class="hideOnMobile">{{ $route->description }}</td>
                                <td>{{ $route->distance }} km</td>
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