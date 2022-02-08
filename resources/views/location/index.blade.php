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
                            <th scope="col">
                                Naam 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByNameUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByNameDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Adres 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByAddressUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByAddressDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Postcode
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByPostalCodeUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByPostalCodeDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col">
                                Plaats
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByResidenceUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByResidenceDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                            <th scope="col" class="hideOnMobile">
                                Land
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByCountryUp') }}"><i class="las la-sort-up fa-lg"></i></a> 
                                <a href="{{ action('App\Http\Controllers\LocationController@sortByCountryDown') }}"><i class="las la-sort-down fa-lg"></i></a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $location)
                            <tr>   
                                <td><a href="{{ action('App\Http\Controllers\LocationController@show', $location->id) }}">{{ $location->name }}</a></td>
                                <td class="hideOnMobile">{{ $location->address }}</td>
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