<x-app-layout>

    <x-slot name="header">
        {{ $ride->name }}
    </x-slot>

    <x-errors class="mb-4" :errors="$errors" />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-3 gap-6 mt-2">
                <div>
                    <a href="{{ action([\App\Http\Controllers\RideController::class, 'download'], $route->id) }}" class="btn btn-outline-primary mt-2">Downloaden</a>
                </div> 
                <div>
                    <x-label><b>Naam</b></x-label>
                    <x-label>{{ $route->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Afstandscategorie</b></x-label>
                    <x-label>{{ $route->distancecategory->distancecategory }}</x-label>
                </div>   
            
            </div>

            <div class="border border-success rounded mt-2">
                <div id="map" style="height:540px"></div>
            </div> 

        </div>
    </div>

    <a href="{{ action([\App\Http\Controllers\RideController::class, 'show'], $ride->id) }}" class="btn btn-outline-primary mt-2">Sluiten</a>  

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
        var gpx = e.target;
        map.fitBounds(gpx.getBounds());
        })
    .addTo(map);
</script>


