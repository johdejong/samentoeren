<x-app-layout>
    <x-slot name="header">
        Ritten
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
                <form method="GET" action="{{ url('ride') }}" accept-charset="UTF-8" class="form-inline" role="search">
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
                            <th scope="col"></th>
                            <th scope="col">
                                Naam 
                                <a href="{{ action('App\Http\Controllers\RideController@sortByNameUp') }}"><i class="las la-sort-alpha-up"></i></a> 
                                <a href="{{ action('App\Http\Controllers\RideController@sortByNameDown') }}"><i class="las la-sort-alpha-down-alt"></i></a>
                            </th>
                            <th scope="col">Datum</th>
                            <th class="text-end" scope="col">
                                Afstand                                 
                                <a href="{{ action('App\Http\Controllers\RideController@sortByDistanceUp') }}"><i class="las la-sort-numeric-up"></i></a>
                                <a href="{{ action('App\Http\Controllers\RideController@sortByDistanceDown') }}"><i class="las la-sort-numeric-down-alt"></i></a>
                                </th>
                            <th scope="col" class="hideOnMobile">Inschrijving</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rides as $ride)
                            <tr>
                                @if ($ride->users->contains(Auth::user()->id))
                                    <td><i class="las la-biking"></i></td>
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


