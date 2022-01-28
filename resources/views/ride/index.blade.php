<x-app-layout>
    <x-slot name="header">
        Toerritten
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
                            <th scope="col"><i class="las la-check-circle"></i></th>
                            <th scope="col"></th>
                            <th scope="col">Naam</th>
                            <th scope="col">Datum</th>
                            <th class="text-end" scope="col">Afstand</th>
                            <th scope="col" class="hideOnMobile">Inschrijving</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rides as $ride)
                            <tr style="transform: rotate(0);">
                                <td scope="row"><a href="{{ action('App\Http\Controllers\RideController@show', $ride->id) }}" class="stretched-link"><i class="las la-check-circle"></i></a></td>
                                @if ($ride->users->contains(Auth::user()->id))
                                    <td><i class="las la-thumbtack"></i></td>
                                @else
                                    <td></td>
                                @endif                                
                                <td><a href="{{ action('App\Http\Controllers\RideController@show', $ride->id) }}">{{ $ride->name }}</a></td>
                                <td>{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}</td>
                                <td class="text-end">{{ $ride->distance }} km</td>
                                <td class="hideOnMobile">{{ $ride->status->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $rides->onEachSide(5)->links() }}
            </div>
        </div>
    </div>
</x-app-layout>


