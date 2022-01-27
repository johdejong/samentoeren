<x-app-layout>
    <x-slot name="header">
        {{ $location->name }}
    </x-slot>

    <x-errors class="mb-4" :errors="$errors" />

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 border-b border-gray-200">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                <div>
                    <x-label><b>ID</b></x-label>
                    <x-label>{{ $location->id }}</x-label>
                </div>
                <div>
                    <x-label><b>Naam</b></x-label>
                    <x-label>{{ $location->name }}</x-label>
                </div>
                <div>
                    <x-label><b>Omschrijving</b></x-label>
                    <x-label>{{ $location->description }}</x-label>
                </div>
                <div>
                    <x-label><b>Adres</b></x-label>
                    <x-label>{{ $location->address }}</x-label>
                </div>
                <div>
                    <x-label><b>Postcode</b></x-label>
                    <x-label>{{ $location->postal_code }}</x-label>
                </div>
                <div>
                    <x-label><b>Plaats</b></x-label>
                    <x-label>{{ $location->residence }}</x-label>
                </div>
                <div>
                    <x-label><b>Land</b></x-label>
                    <x-label>{{ $location->country->name }} ({{ $location->country->code }})</x-label>
                </div>
            </div>

            <div class="border border-success rounded mt-2">
                <div id="map" style="height:400px"></div>
            </div> 

        </div>        
    </div>

    <div class="mt-2">
        <a href="{{ action('App\Http\Controllers\LocationController@index') }}" class="btn btn-outline-primary">Sluiten</a>
    </div>
</x-app-layout>

<script>
    var map = L.map('map').setView([ {{ $location->latitude }}, {{ $location->longitude }} ], 15);
    var marker = L.marker( [ {{ $location->latitude }}, {{ $location->longitude }} ]).addTo(map);

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Kaartdata &copy; <a href="http://www.osm.org">OpenStreetMap</a>'
    }).addTo(map);
</script>

