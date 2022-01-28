<x-app-layout>
    <x-slot name="header">
        {{ $ride->name }}
    </x-slot>

    @if ($message = Session::get('success'))
        <div id="success" class="inline-flex w-full mb-4 overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-center w-12 bg-green-500">
                <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z">
                    </path>
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3">
                    <span class="font-semibold text-green-500">Deelname</span>
                    <p class="text-sm text-gray-600">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

    <x-errors class="mb-4" :errors="$errors" />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div>
                    @if ( $ride->status->id === 1 )
                        @if (!$ride->users->contains(Auth::user()->id))
                            <span class="badge bg-warning text-dark mr-2 mb-2">Je bent nog niet aangemeld</span><a href="{{ action('App\Http\Controllers\RideController@join', $ride->id) }}" class="btn btn-outline-primary">Aanmelden</a>
                        @else
                            <span class="badge bg-success mr-2 mb-2">Je bent aangemeld</span><a href="{{ action('App\Http\Controllers\RideController@unjoin', $ride->id) }}" class="btn btn-outline-primary">Afmelden</a>
                        @endif
                    @else
                        <a href="#" class="btn btn-outline-secondary disabled">Inschrijving gesloten</a>
                    @endif
                </div>
                <div>
                    <x-label><b>Naam</b></x-label>
                    <x-label>{{ $ride->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Omschrijving</b></x-label>
                    <x-label>{{ $ride->description }}</x-label>
                </div>
                <div>
                    <x-label><b>Type</b></x-label>
                    <x-label>{{ $ride->type->type }}</x-label>
                </div>
                <div>
                    <x-label><b>Status</b></x-label>
                    <x-label>{{ $ride->status->status }}</x-label>
                </div>
                <div>
                    <x-label><b>Afstand</b></x-label>
                    <x-label>{{ $ride->distance }} km</x-label>
                </div>
            </div>

            <hr>

            <h6 class="mt-4">Vertrek</h6>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div>
                    <x-label><b>Locatie</b></x-label>
                    <x-label>{{ $ride->start_location->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Datum</b></x-label>
                    <x-label>{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}</x-label>
                </div>
                <div>
                    <x-label><b>Tijd</b></x-label>
                    <x-label>{{ \Carbon\Carbon::parse($ride->start_time)->format('h:i') }} uur</x-label>
                </div>  
                <div>
                    <x-label><b>Adres</b></x-label>
                    <x-label>{{ $ride->start_location->address }}</x-label>
                </div>
                <div>
                    <x-label><b>Postcode</b></x-label>
                    <x-label>{{ $ride->start_location->postal_code }}</x-label>
                </div>
                <div>
                    <x-label><b>Plaats</b></x-label>
                    <x-label>{{ $ride->start_location->residence }}</x-label>
                </div>                
            </div>

            <hr>

            <h6 class="mt-4">Aankomst</h6>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div>
                    <x-label><b>Locatie</b></x-label>
                    <x-label>{{ $ride->finish_location->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Datum</b></x-label>
                    <x-label>{{ \Carbon\Carbon::parse($ride->finish_date)->formatLocalized('%A %e %B %Y') }}</x-label>
                </div>
                <div>
                    <x-label><b>Tijd</b></x-label>
                    <x-label>{{ \Carbon\Carbon::parse($ride->finish_time)->format('h:i') }} uur</x-label>
                </div>  
                <div>
                    <x-label><b>Adres</b></x-label>
                    <x-label>{{ $ride->finish_location->address }}</x-label>
                </div>
                <div>
                    <x-label><b>Postcode</b></x-label>
                    <x-label>{{ $ride->finish_location->postal_code }}</x-label>
                </div>
                <div>
                    <x-label><b>Plaats</b></x-label>
                    <x-label>{{ $ride->finish_location->residence }}</x-label>
                </div>                
            </div>

            <hr>

            <h6 class="mt-4">Deelnemer(s)</h6>
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($ride->users as $user)
                    @if ($user->id === Auth::user()->id)
                        <div><x-label><b>** {{ $user->name }} **</b></x-label></div>
                    @else
                        <div><x-label>{{ $user->name }}</x-label></div>
                    @endif
                @endforeach       
            </div>

            <hr>

            <h6 class="mt-4">Route(s)</h6>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                @foreach ($ride->routes as $route)
                    <div>
                        <x-label>{{ $route->name }}</x-label>
                        <a href="{{ action('App\Http\Controllers\RideController@map', [$ride->id, $route->id]) }}" class="btn btn-outline-primary mt-2">Kaart</a>
                        <a href="{{ action('App\Http\Controllers\RideController@download', $route->id) }}" class="btn btn-outline-primary mt-2">Downloaden</a>
                    </div>
                @endforeach       
            </div>

        </div>
    </div>

    <div class="mt-2">
        <a href="{{ action('App\Http\Controllers\RideController@index') }}" class="btn btn-outline-primary">Sluiten</a>
    </div>
</x-app-layout>

<script>
    $(document).ready(function(){
        $("#success").delay(5000).slideUp(300);
    });
</script>

