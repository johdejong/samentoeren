<x-app-layout>
    <x-slot name="header">
        Start - en finish locaties
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
                <form method="GET" action="{{ url('location') }}" accept-charset="UTF-8" class="form-inline" role="search">
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
                            <th scope="col">Adres</th>
                            <th scope="col" class="hideOnMobile">Postcode</th>
                            <th scope="col" class="hideOnMobile">Plaats</th>
                            <th scope="col" class="hideOnMobile">Land</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>   
                                <td><a href="{{ action('App\Http\Controllers\LocationController@show', $location->id) }}">{{ $location->name }}</a></td>
                                <td>{{ $location->address }}</td>
                                <td class="hideOnMobile">{{ $location->postal_code }}</td>
                                <td>{{ $location->residence }}</td>
                                <td class="hideOnMobile">{{ $location->country->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $locations->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
