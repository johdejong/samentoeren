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
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></i></th>
                            <th scope="col">Naam</th>
                            <th scope="col">Adres</th>
                            <th scope="col" class="hideOnMobile">Postcode</th>
                            <th scope="col" class="hideOnMobile">Plaats</th>
                            <th scope="col" class="hideOnMobile">Land</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr style="transform: rotate(0);">
                                <td scope="row"><a href="{{ action('App\Http\Controllers\LocationController@show', $location->id) }}" class="stretched-link"></td>         
                                <td>{{ $location->name }}</td>
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
