<x-app-layout>
    <x-slot name="header">
        {{ $route->name }}
    </x-slot>

    <x-errors class="mb-4" :errors="$errors" />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div>
                    <x-label><b>ID</b></x-label>
                    <x-label>{{ $route->id }}</x-label>
                </div>
                <div>
                    <x-label><b>Naam</b></x-label>
                    <x-label>{{ $route->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Omschrijving</b></x-label>
                    <x-label>{{ $route->description }}</x-label>
                </div>
                <div>
                    <x-label><b>Afstand</b></x-label>
                    <x-label>{{ $route->distance }}</x-label>
                </div>
                <div>
                    <x-label><b>Afstandscategorie</b></x-label>
                    <x-label>{{ $route->distancecategory->distancecategory }}</x-label>
                </div>
                <div>
                    <x-label><b>Vertrek</b></x-label>
                    <x-label>{{ $route->start_residence->residence }}</x-label>
                </div>
                <div>
                    <x-label><b>Aankomst</b></x-label>
                    <x-label>{{ $route->finish_residence->residence }}</x-label>
                </div>
                <div>
                    <x-label><b>Bestandsgrootte</b></x-label>
                    <x-label>{{ $route->size }} kb</x-label>
                </div>
                <div>
                    <a href="{{ action('App\Http\Controllers\RouteController@download', $route->id) }}" class="btn btn-outline-primary mt-2">Downloaden</a>
                </div>
            </div>

            <div class="border border-success rounded mt-2">
                <div id="map" style="height:460px"></div>
            </div> 
        </div>        
    </div>

    <div class="mt-2">
        <a href="{{ action('App\Http\Controllers\RouteController@index') }}" class="btn btn-outline-primary">Sluiten</a>
    </div>
</x-app-layout>

<script>
    var map = L.map('map');

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Kaartdata &copy; <a href="http://www.osm.org">OpenStreetMap</a>'
    }).addTo(map);

    var gpx = '../../../storage/' + {!! json_encode($route->image) !!};

    new L.GPX(gpx, {
        async: true,
        marker_options: {
        startIconUrl: '../../../storage/icons/pin-icon-start.png',
        endIconUrl: '../../../storage/icons/pin-icon-end.png',
        shadowUrl: '../../../storage/icons/pin-shadow.png',
        wptIconUrls: '../../../storage/icons/pin-icon-wpt.png',
        }
    })
    .on('loaded', function(e) { 
        map.fitBounds(e.target.getBounds());
        })
    .addTo(map);
</script>


