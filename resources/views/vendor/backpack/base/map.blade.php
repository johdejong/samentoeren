@extends(backpack_view('blank'))

@section('content')
    <h2>{{ $name }}</h2>

    <div class="border border-success rounded">
        <div id="map" style="height:640px"></div>
    </div>

    <button type="button" class="btn btn-link"><a href="{{ URL::previous() }}">Kaart sluiten</a></button>
@endsection

@push('after_scripts')
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-gpx/1.7.0/gpx.min.js"></script>

    <script>
        var map = L.map('map');

        L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: 'Kaartdata &copy; <a href="http://www.osm.org">OpenStreetMap</a>'
        }).addTo(map);

        var gpx = '../../../storage/' + {!! json_encode($image) !!};

        new L.GPX(gpx, {
            async: true,
            marker_options: {
            startIconUrl: '../../../storage/icons/pin-icon-start.png',
            endIconUrl: '../../../storage/icons/pin-icon-end.png',
            shadowUrl: '../../../storage/icons/pin-shadow.png',
            wptIconUrls: '../../../storage/icons/pin-icon-wpt.png',
            }
        })
        .on('loaded', function(e) { map.fitBounds(e.target.getBounds()); })
        .addTo(map);
    </script>
@endpush
