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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Naam</th>
                            <th scope="col" class="hideOnMobile">Omschrijving</th>
                            <th scope="col">Afstandscategorie</th>
                            <th scope="col" class="hideOnMobile text-end">Bestandsgrootte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($routes as $route)
                            <tr>     
                                <td><a href="{{ action('App\Http\Controllers\RouteController@show', $route->id) }}">{{ $route->name }}</a></td>
                                <td class="hideOnMobile">{{ $route->description }}</td>
                                <td>{{ $route->distancecategory->distancecategory }}</td>
                                <td class="hideOnMobile text-end">{{ $route->size }} kb</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $routes->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>